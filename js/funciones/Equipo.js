function agregarEquipo() {
    var cod_equ = $('#cod_equ').val();
    var marca = $('#marca').val();
    var valor = $('#valor').val();
    var estado = $('#estado').val();
    var descripcion = $('#descripcion').val();
    var cod_sal = $('#cod_sal').val();
    var cod_disp = $('#cod_disp').val();
    if (cod_equ.trim() == '') {
        alertify.alert('Entrada invalida', 'El equipo debe tener un serial');
        $('#cod_equ').focus();
        return false;
    } else if (cod_equ.length > 100) {
        alertify.alert('Entrada invalida', 'El serial debe contener maximo 100 caracteres');
        $('#cod_equ').focus();
        return false;
    } else if (marca.length > 30) {
        alertify.alert('Entrada invalida', 'La marca debe contener maximo 30 caracteres');
        $('#marca').focus();
        return false;
    } else if (!(valor > 0)) {
        alertify.alert('Entrada invalida', 'El equipo debe tener un valor');
        $('#valor').focus();
        return false;
    } else if (descripcion.length > 50) {
        alertify.alert('Entrada invalida', 'La descripcion debe tener maximo 50 caracteres');
        $('#descripcion').focus();
        return false;
    } else if (cod_disp < 1) {
        alertify.alert('Entrada invalida', 'El equipo debe pertenecer a un dispositivo');
        $('#descripcion').focus();
        return false;
    } else if (estado.trim() == '') {
        alertify.alert('Entrada invalida', 'El equipo debe tener un estado');
        $('#estado').focus();
        return false;
    } else if (cod_sal < 1) {
        alertify.alert('Entrada invalida', 'El equipo debe estar en una sala');
        $('#cod_sal').focus();
        return false;
    } else {
        cadena = "cod_equ=" + cod_equ +
            "&marca=" + marca +
            "&valor=" + valor +
            "&estado=" + estado +
            "&descripcion=" + descripcion +
            "&cod_sal=" + cod_sal +
            "&cod_disp=" + cod_disp;
        $.ajax({
            type: 'POST',
            url: '../app/Validadores/ValidadorEquipo.php',
            data: cadena,
            success: function (r) {
                console.log(r);
                if (r == 1) {
                    $('#equipos').load('../gestores/gestor-equipos.php');
                    alertify.success("Equipo Ingresado con exito");
                    $('#Equiponuevo').modal('hide');
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
function agregaFormEquipo(datos) {
    d = datos.split('||');
    $('#cod_equ').val(d[0]);
    $('#cod_equU').val(d[0]);
    $('#marcaU').val(d[1]);
    $('#valorU').val(d[2]);
    $('#estadoU').val(d[3]);
    $('#descripcionU').val(d[4]);
    $('#cod_salU').val(d[5]);
    $('#cod_dispU').val(d[6]);
}

function actualizarEquipo() {
    cod_equ = $('#cod_equ').val();
    cod_equU = $('#cod_equU').val();
    marcaU = $('#marcaU').val();
    valorU = $('#valorU').val();
    estadoU = $('#estadoU').val();
    descripcionU = $('#descripcionU').val();
    cod_salU = $('#cod_salU').val();
    cod_dispU = $('#cod_dispU').val();
    if (cod_equU.trim() == '') {
        alertify.alert('Entrada invalida', 'El equipo debe tener un serial');
        $('#cod_equU').focus();
        return false;
    } else if (cod_equU.length > 100) {
        alertify.alert('Entrada invalida', 'El serial debe contener maximo 100 caracteres');
        $('#cod_equU').focus();
        return false;
    } else if (marcaU.length > 30) {
        alertify.alert('Entrada invalida', 'La marca debe contener maximo 30 caracteres');
        $('#marcaU').focus();
        return false;
    } else if (!(valorU > 0)) {
        alertify.alert('Entrada invalida', 'El equipo debe tener un valor');
        $('#valorU').focus();
        return false;
    } else if (descripcionU.length > 50) {
        alertify.alert('Entrada invalida', 'La descripcion debe tener maximo 50 caracteres');
        $('#descripcionU').focus();
        return false;
    } else if (cod_dispU < 1) {
        alertify.alert('Entrada invalida', 'El equipo debe pertenecer a un dispositivo');
        $('#cod_dispU').focus();
        return false;
    } else if (estadoU.trim() == '') {
        alertify.alert('Entrada invalida', 'El equipo debe tener un estado');
        $('#estadoU').focus();
        return false;
    } else if (cod_salU < 1) {
        alertify.alert('Entrada invalida', 'El equipo debe estar en una sala');
        $('#cod_salU').focus();
        return false;
    } else {
        cadena = "cod_equ=" + cod_equ +
            "&cod_equU=" + cod_equU +
            "&marcaU=" + marcaU +
            "&valorU=" + valorU +
            "&estadoU=" + estadoU +
            "&descripcionU=" + descripcionU +
            "&cod_salU=" + cod_salU +
            "&cod_dispU=" + cod_dispU;
        $.ajax({
            type: "POST",
            url: "../app/Validadores/ValidadorEquipo.php",
            data: cadena,
            success: function (r) {
                if (r == 1) {
                    $('#equipos').load('../gestores/gestor-equipos.php');
                    alertify.success("Equipo actualizado con exito");
                    $('#Equipoeditar').modal('hide');
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
function preguntarSiNoEqu(cod_equ) {
    alertify.confirm('Eliminar datos', '¿Esta seguro de eliminar este registro?',
        function () { eliminarEquipo(cod_equ) }
        , function () { alertify.error('Operacion cancelada') });

}
function eliminarEquipo(cod_equ) {
    cadena = "cod_equE=" + cod_equ;
    $.ajax({
        type: "POST",
        url: "../app/Validadores/ValidadorEquipo.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                $('#equipos').load('../gestores/gestor-equipos.php');
                alertify.success("Equipo eliminado con exito");
            } else {
                alertify.error(r);
            }
        }
    });
}

