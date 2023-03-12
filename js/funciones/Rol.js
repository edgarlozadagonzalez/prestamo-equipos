function agregarRol(nombre_rol) {
    var nombre_rol = $('#nombre_rol').val();
    if (nombre_rol.trim() == '') {
        alertify.alert('Entrada invalida', 'Debe ingresar el rol');
        $('#nombre_rol').focus();
        return false;
    } else if (nombre_rol.length > 30) {
        alertify.alert('Entrada invalida', 'El rol debe contener maximo 30 caracteres');
        $('#nombre_rol').focus();
        return false;
    } else {
        cadena = "nombre_rol=" + nombre_rol;
        $.ajax({
            type: 'POST',
            url: '../app/Validadores/ValidadorRol.php',
            data: cadena,
            success: function (r) {
                console.log(r);
                if (r == 1) {
                    $('#roles').load('../gestores/gestor-roles.php');
                    alertify.success("Rol Ingresado con exito");
                    $('#Rolnuevo').modal('hide');
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
function agregaFormRol(datos) {
    d = datos.split('||');
    $('#cod_rolU').val(d[0]);
    $('#nombre_rolU').val(d[1]);
}

function actualizarRol() {
    cod_rolU = $('#cod_rolU').val();
    nombre_rolU = $('#nombre_rolU').val();
    if (nombre_rolU.trim() == '') {
        alertify.alert('Entrada invalida', 'Debe ingresar el rol');
        $('#nombre_rolU').focus();
        return false;
    } else if (nombre_rolU.length > 30) {
        alertify.alert('Entrada invalida', 'El rol debe contener maximo 30 caracteres');
        $('#nombre_rolU').focus();
        return false;
    } else {
        cadena = "cod_rolU=" + cod_rolU +
            "&nombre_rolU=" + nombre_rolU;
        $.ajax({
            type: "POST",
            url: "../app/Validadores/ValidadorRol.php",
            data: cadena,
            success: function (r) {
                if (r == 1) {
                    $('#roles').load('../gestores/gestor-roles.php');
                    alertify.success("Rol actualizado con exito");
                    $('#Roleditar').modal('hide');
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
function preguntarSiNoRol(cod_rol) {
    alertify.confirm('Eliminar datos', '¿Esta seguro de eliminar este registro?',
        function () { eliminarRol(cod_rol) }
        , function () { alertify.error('Operacion cancelada') });

}
function eliminarRol(cod_rol) {
    cadena = "cod_rolE=" + cod_rol;
    $.ajax({
        type: "POST",
        url: "../app/Validadores/ValidadorRol.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                $('#roles').load('../gestores/gestor-roles.php');
                alertify.success("Rol eliminado con exito");
            } else {
                alertify.error(r);
            }
        }
    });
}