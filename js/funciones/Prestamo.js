function preguntarSiNoPrestamo(cod_equ, cod_per) {
    alertify.confirm('Adquirir prestamo', '¿Esta seguro de adquirir prestado este equipo?',
        function () { prestarEquipo(cod_equ, cod_per) }
        , function () { alertify.error('Prestamo cancelado') });

}

function prestarEquipo(cod_equ, cod_per) {

    cadena = "cod_equ=" + cod_equ +
        "&cod_per=" + cod_per;
    $.ajax({
        type: "POST",
        url: "app/Validadores/ValidadorPrestamo.php",
        data: cadena,
        success: function (r) {
            console.log(cod_equ);
            console.log(cod_per);
            if (r == 1) {
                $('#equiposdisponibles').load('vistas/disponibles.php');
                alertify.success("Equipo solicitado con exito");
            } else {
                alertify.error(r);
            }
        }
    });
}
function preguntarSiNoDevolver(cod_equ, cod_pres) {
    alertify.confirm('Devolver equipo', '¿Esta seguro que desea devolver este equipo?',
        function () { devolverEquipo(cod_equ, cod_pres) }
        , function () { alertify.error('Devolucion cancelada') });

}
function devolverEquipo(cod_equ, cod_pres) {
    cadena = "cod_equD=" + cod_equ +
        "&cod_pres=" + cod_pres;
    $.ajax({
        type: "POST",
        url: "../app/Validadores/ValidadorPrestamo.php",
        data: cadena,
        success: function (r) {
            console.log(cod_equ);
            console.log(cod_pres);
            if (r == 1) {
                $('#devolverequipo').load('../vistas/devolucion.php');
                alertify.success("Equipo devuelto con exito");
            } else {
                alertify.error(r);
            }
        }
    });
}
function agregarPrestamo() {
    fecha_inicio = $('#fecha_inicio').val();
    fecha_fin = $('#fecha_fin').val();
    cod_per = $('#cod_per').val();
    cod_equ = $('#cod_equ').val();

    if (fecha_inicio.trim() == '') {
        alertify.alert('Entrada invalida', 'El prestamo debe tener una fecha de prestamo');
        $('#fecha_inicio').focus();
        return false;
    } else if (fecha_fin.trim() !== '' && fecha_inicio > fecha_fin) {
        alertify.alert('Entrada invalida', 'La fecha de devolucion debe ser mayor a la fecha del prestamo');
        $('#fecha_fin').focus();
        return false;
    } else if (cod_per.trim() == '') {
        alertify.alert('Entrada invalida', 'Debe ingresar el numero de identificacion de la persona');
        $('#cod_per').focus();
        return false;
    } else if (cod_equ.trim() == '') {
        alertify.alert('Entrada invalida', 'Debe ingresar el serial del equipo');
        $('#cod_equ').focus();
        return false;
    } else {
        cadena = "fecha_inicio=" + fecha_inicio +
            "&fecha_fin=" + fecha_fin +
            "&cod_per=" + cod_per +
            "&cod_equA=" + cod_equ;
        $.ajax({
            type: "POST",
            url: "../app/Validadores/ValidadorPrestamo.php",
            data: cadena,
            success: function (r) {
                if (r == 1) {
                    $('#prestamos').load('../gestores/gestor-prestamo.php');
                    alertify.success("Prestamo agregado con exito");
                    $('#Prestamonuevo').modal('hide');
                    if ($('.modal-backdrop').is(':visible')) {
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                    };
                } else {
                    alertify.error(r);
                }
            }
        });
    }
}
function actualizarPrestamo() {
    cod_pres = $('#cod_pres').val();
    fecha_inicioU = $('#fecha_inicioU').val();
    fecha_finU = $('#fecha_finU').val();
    cod_perU = $('#cod_perU').val();
    cod_equU = $('#cod_equU').val();
    if (fecha_inicioU.trim() == '') {
        alertify.alert('Entrada invalida', 'El prestamo debe tener una fecha de prestamo');
        $('#fecha_inicioU').focus();
        return false;
    } else if (fecha_finU.trim() !== '' && fecha_inicioU > fecha_finU) {
        alertify.alert('Entrada invalida', 'La fecha de devolucion debe ser mayor a la fecha del prestamo');
        $('#fecha_finU').focus();
        return false;
    } else if (cod_perU.trim() == '') {
        alertify.alert('Entrada invalida', 'Debe ingresar el numero de identificacion de la persona');
        $('#cod_perU').focus();
        return false;
    } else if (cod_equU.trim() == '') {
        alertify.alert('Entrada invalida', 'Debe ingresar el serial del equipo');
        $('#cod_equU').focus();
        return false;
    } else {
        cadena = "cod_presU=" + cod_pres +
            "&fecha_inicioU=" + fecha_inicioU +
            "&fecha_finU=" + fecha_finU +
            "&cod_perU=" + cod_perU +
            "&cod_equU=" + cod_equU ;
            $.ajax({
                type: "POST",
                url: "../app/Validadores/ValidadorPrestamo.php",
                data: cadena,
                success: function (r) {
                    if (r == 1) {
                        $('#prestamos').load('../gestores/gestor-prestamo.php');
                        alertify.success("Prestamo actualizado con exito");
                        $('#Prestamoeditar').modal('hide');
                        if ($('.modal-backdrop').is(':visible')) {
                            $('body').removeClass('modal-open');
                            $('.modal-backdrop').remove();
                        };
                    } else {
                        console.log(r);
                        alertify.error(r);
                    }
                }
            });
    }
}

function preguntarSiNoPres(cod_pres) {
    alertify.confirm('Eliminar datos', '¿Esta seguro de eliminar este registro?',
        function () { eliminarPrestamo(cod_pres) }
        , function () { alertify.error('Operacion cancelada') });

}

function agregaFormPrestamo(datos) {
    d = datos.split('||');
    $('#cod_pres').val(d[0]);
    $('#fecha_inicioU').val(d[1]);
    $('#fecha_finU').val(d[2]);
    $('#cod_perU').val(d[3]);
    $('#cod_equU').val(d[4]);

}

function eliminarPrestamo(cod_pres,cod_equ) {
    cadena = "cod_presE=" + cod_pres +
             "&cod_equ=" + cod_equ  ;
    $.ajax({
        type: "POST",
        url: "../app/Validadores/ValidadorPrestamo.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                $('#prestamos').load('../gestores/gestor-prestamo.php');
                alertify.success("Prestamo eliminado con exito");
            } else {
                alertify.error(r);
            }
        }
    });
}