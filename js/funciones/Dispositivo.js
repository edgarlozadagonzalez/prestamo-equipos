function agregarDispositivo() {
    var nombre_disp = $('#nombre_disp').val();
    if (nombre_disp.trim() == '') {
        alertify.alert('Entrada invalida', 'Debe ingresar el dispositivo');
        $('#nombre_disp').focus();
        return false;
    } else if (nombre_disp.length > 30) {
        alertify.alert('Entrada invalida', 'El dispositivo debe contener maximo 30 caracteres');
        $('#nombre_disp').focus();
        return false;
    } else {
        cadena = "nombre_disp=" + nombre_disp;
        $.ajax({
            type: 'POST',
            url: '../app/Validadores/ValidadorDispositivo.php',
            data: cadena,
            success: function (r) {
                console.log(r);
                if (r == 1) {
                    $('#dispositivos').load('../gestores/gestor-dispositivos.php');
                    alertify.success("Dispositivo ingresado con exito");
                    $('#Dispositivonuevo').modal('hide');
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
function agregaFormDispositivo(datos) {
    d = datos.split('||');
    $('#cod_dispU').val(d[0]);
    $('#nombre_dispU').val(d[1]);
}

function actualizarDispositivo() {
    cod_dispU = $('#cod_dispU').val();
    nombre_dispU = $('#nombre_dispU').val();
    if (nombre_dispU.trim() == '') {
        alertify.alert('Entrada invalida', 'Debe ingresar el dispositivo');
        $('#nombre_dispU').focus();
        return false;
    } else if (nombre_dispU.length > 30) {
        alertify.alert('Entrada invalida', 'El dispositivo debe contener maximo 30 caracteres');
        $('#nombre_dispU').focus();
        return false;
    } else {
        cadena = "cod_dispU=" + cod_dispU +
            "&nombre_dispU=" + nombre_dispU;
        $.ajax({
            type: "POST",
            url: "../app/Validadores/ValidadorDispositivo.php",
            data: cadena,
            success: function (r) {
                if (r == 1) {
                    $('#dispositivos').load('../gestores/gestor-dispositivos.php');
                    alertify.success("Dispositivo actualizado con exito");
                    $('#Dispositivoeditar').modal('hide');
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
function preguntarSiNoDisp(cod_disp) {
    alertify.confirm('Eliminar datos', '¿Esta seguro de eliminar este registro?',
        function () { eliminarDispositivo(cod_disp) }
        , function () { alertify.error('Operacion cancelada') });

}
function eliminarDispositivo(cod_disp) {
    cadena = "cod_dispE=" + cod_disp;
    $.ajax({
        type: "POST",
        url: "../app/Validadores/ValidadorDispositivo.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                $('#dispositivos').load('../gestores/gestor-dispositivos.php');
                alertify.success("Dispositivo eliminado con exito");
            } else {
                alertify.error("Imposible eliminar,hay equipos de este tipo de dispositivo");
            }
        }
    });
}