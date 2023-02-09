CREATE TABLE ROLES(
    cod_rol SERIAL NOT NULL PRIMARY KEY ,
    nombre_rol VARCHAR(30) NOT NULL UNIQUE
);

CREATE TABLE FACULTADES(
    cod_fac SERIAL NOT NULL PRIMARY KEY,
    nombre_fac VARCHAR(30) NOT NULL UNIQUE
);

CREATE TABLE PERSONAS (
    cod_per BIGINT NOT NULL PRIMARY KEY,
    pri_nombre VARCHAR(15) NOT NULL,
    seg_nombre VARCHAR(15),
    ter_nombre VARCHAR(15),
    pri_apellido VARCHAR(15) NOT NULL,
    seg_apellido VARCHAR(15) NOT NULL,
    fecha_nac DATE NOT NULL,
    edad INT,
    email VARCHAR(255) NOT NULL UNIQUE,
    clave VARCHAR(255) NOT NULL ,
    telefono BIGINT NOT NULL UNIQUE,
    CHECK(AGE(fecha_nac)>='15 years 0 mons 0 days'),
    CHECK(telefono>0),
    CHECK(fecha_nac < CURRENT_DATE),
    cod_rol INT NOT NULL,
    cod_fac INT NOT NULL,

    CONSTRAINT fk_cod_rol FOREIGN KEY (cod_rol) REFERENCES ROLES(cod_rol) ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT fk_cod_fac FOREIGN KEY (cod_fac) REFERENCES FACULTADES(cod_fac) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE EDIFICIOS (
    cod_edif SERIAL NOT NULL PRIMARY KEY,
    nombre_edif VARCHAR(30) NOT NULL,
    num_pisos INT NOT NULL,
    CHECK(num_pisos>0),
    sede VARCHAR(30) NOT NULL
);

CREATE TABLE SALAS (
    cod_sal SERIAL NOT NULL PRIMARY KEY,
    nombre_sal VARCHAR(30) NOT NULL,
    num_piso INT NOT NULL,
    plataforma VARCHAR(30) NOT NULL,
    CHECK(num_piso>0),
    cod_edif INT NOT NULL ,
    CONSTRAINT fk_cod_edif FOREIGN KEY (cod_edif) REFERENCES EDIFICIOS(cod_edif) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE DISPOSITIVOS (
    cod_disp SERIAL NOT NULL PRIMARY KEY,
    nombre_disp VARCHAR(30) NOT NULL UNIQUE
);

CREATE TABLE EQUIPOS(
    cod_equ VARCHAR(50) NOT NULL PRIMARY KEY,
    marca VARCHAR(30) NOT NULL,
    valor FLOAT NOT NULL ,
    estado BOOLEAN NOT NULL,
    descripcion VARCHAR(50),
    CHECK (valor>0),
    cod_sal INT NOT NULL,
    cod_disp INT NOT NULL,
    CONSTRAINT fk_cod_sal FOREIGN KEY (cod_sal) REFERENCES SALAS(cod_sal) ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT fk_cod_disp FOREIGN KEY (cod_disp) REFERENCES DISPOSITIVOS(cod_disp) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE PRESTAMOS(
    cod_pres SERIAL NOT NULL PRIMARY KEY,
    fecha_inicio TIMESTAMP NOT NULL, 
    fecha_fin TIMESTAMP,
    cod_per BIGINT NOT NULL,
    cod_equ VARCHAR(50) NOT NULL,
    CHECK(fecha_inicio < fecha_fin),
    CONSTRAINT fk_cod_per FOREIGN KEY (cod_per) REFERENCES PERSONAS(cod_per) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_cod_equ FOREIGN KEY (cod_equ) REFERENCES EQUIPOS(cod_equ) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE HISTORIAL(
    cod_pres INT NOT NULL PRIMARY KEY,
    fecha_inicio TIMESTAMP NOT NULL, 
    fecha_fin TIMESTAMP NOT NULL,
    cod_per BIGINT NOT NULL,
    email VARCHAR(255) NOT NULL,
    telefono BIGINT NOT NULL,
    cod_equ VARCHAR(50) NOT NULL,
    marca VARCHAR(30) NOT NULL,
    descripcion VARCHAR(50),
    nombre_disp VARCHAR(30) NOT NULL,
    nombre_sal VARCHAR(30) NOT NULL,
    num_piso INT NOT NULL
);


CREATE OR REPLACE VIEW sindevolver AS
SELECT
pres.cod_pres,pres.fecha_inicio,pres.cod_per,pres.cod_equ,equ.marca,equ.descripcion,disp.nombre_disp,sal.nombre_sal,sal.num_piso FROM prestamos as pres 
INNER JOIN equipos as equ ON pres.cod_equ= equ.cod_equ  
INNER JOIN dispositivos as disp ON equ.cod_disp=disp.cod_disp 
INNER JOIN salas as sal ON equ.cod_sal=sal.cod_sal 
WHERE pres.fecha_fin is null;

CREATE OR REPLACE VIEW equiposdisponibles AS
SELECT eq.cod_equ,eq.marca,eq.descripcion,
(SELECT disp.nombre_disp FROM dispositivos as disp WHERE disp.cod_disp = eq.cod_disp), 
(SELECT sal.nombre_sal FROM salas as sal WHERE sal.cod_sal = eq.cod_sal),
(SELECT sal.num_piso FROM salas as sal WHERE sal.cod_sal=eq.cod_sal)
FROM equipos as eq WHERE estado = '1';

CREATE OR REPLACE FUNCTION adicionar_datos() RETURNS TRIGGER AS $$
DECLARE 
BEGIN 
NEW.edad := (SELECT EXTRACT(year from current_date::DATE)) - extract('year' from NEW.fecha_nac::DATE); 
RETURN NEW; 
END; 
$$ LANGUAGE plpgsql;

CREATE TRIGGER adicionar BEFORE INSERT OR UPDATE ON personas FOR EACH ROW EXECUTE PROCEDURE adicionar_datos();

CREATE OR REPLACE VIEW personasview AS 
SELECT per.cod_per, per.pri_nombre,per.pri_apellido,
per.edad,per.email,per.telefono,
(SELECT nombre_rol FROM roles WHERE cod_rol=per.cod_rol) AS rol,
(SELECT nombre_fac FROM facultades WHERE cod_fac = per.cod_fac) AS facultad FROM personas AS per;

CREATE OR REPLACE VIEW equiposaveriados AS 
SELECT eq.cod_equ,eq.marca,eq.valor,eq.descripcion,sal.nombre_sal,dis.nombre_disp FROM equipos as eq 
INNER JOIN salas as sal ON eq.cod_sal=sal.cod_sal 
INNER JOIN dispositivos as dis ON eq.cod_disp = dis.cod_disp 
WHERE NOT EXISTS(SELECT cod_equ FROM sindevolver as sn WHERE eq.cod_equ=sn.cod_equ) 
AND eq.estado ='0';


\COPY ROLES(nombre_rol) FROM 'D:\Ingenieria De Sistemas\Base de datos\Proyecto\Codigo\prestamo-equipos\sql\Datos\roles.csv' WITH(FORMAT csv,HEADER,DELIMITER ',');
\COPY FACULTADES(nombre_fac) FROM 'D:\Ingenieria De Sistemas\Base de datos\Proyecto\Codigo\prestamo-equipos\sql\Datos\facultades.csv' WITH(FORMAT csv,HEADER,DELIMITER ',');
\COPY EDIFICIOS(nombre_edif,num_pisos,sede) FROM 'D:\Ingenieria De Sistemas\Base de datos\Proyecto\Codigo\prestamo-equipos\sql\Datos\edificios.csv' WITH(FORMAT csv,HEADER,DELIMITER ',');
\COPY SALAS(nombre_sal,num_piso,plataforma,cod_edif) FROM 'D:\Ingenieria De Sistemas\Base de datos\Proyecto\Codigo\prestamo-equipos\sql\Datos\salas.csv' WITH(FORMAT csv,HEADER,DELIMITER ',');
\COPY DISPOSITIVOS(nombre_disp) FROM 'D:\Ingenieria De Sistemas\Base de datos\Proyecto\Codigo\prestamo-equipos\sql\Datos\dispositivos.csv' WITH(FORMAT csv,HEADER,DELIMITER ',');
\COPY EQUIPOS(cod_equ,marca,valor,estado,descripcion,cod_sal,cod_disp) FROM 'D:\Ingenieria De Sistemas\Base de datos\Proyecto\Codigo\prestamo-equipos\sql\Datos\equipos.csv' WITH(FORMAT csv,HEADER,DELIMITER ',');
