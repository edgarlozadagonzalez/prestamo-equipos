function agregarEdificio() {
    var nombre_edif = $('#nombre_edif').val();
    var num_pisos = $('#num_pisos').val();
    var sede = $('#sede').val();
    if (nombre_edif.trim() == '') {
        alertify.alert('Entrada invalida', 'El edificio debe tener un nombre');
        $('#nombre_edif').focus();
    } else if (nombre_edif.length > 30) {
        alertify.alert('Entrada invalida', 'El nombre del edificio debe contener maximo 30 caracteres');
        $('#nombre_edif').focus();
        return false;
    } else if (num_pisos < 0 || num_pisos.trim() == '') {
        alertify.alert('Entrada invalida', 'El numero de pisos debe ser mayor a 0');
        $('#num_pisos').focus();
        return false;
    } else if (sede.trim() == '') {
        alertify.alert('Entrada invalida', 'El edificio debe tener una sede');
        $('#sede').focus();
        return false;
    } else if (sede.length > 30) {
        alertify.alert('Entrada invalida', 'La sede debe tener maximo 30 caracteres');
        $('#sede').focus();
        return false;
    } else {
        cadena = "nombre_edif=" + nombre_edif +
            "&num_pisos=" + num_pisos +
            "&sede=" + sede;
        $.ajax({
            type: 'POST',
            url: '../app/Validadores/ValidadorEdificio.php',
            data: cadena,
            success: function (r) {
                console.log(r);
                if (r == 1) {
                    $('#edificios').load('../gestores/gestor-edificios.php');
                    alertify.success("Edificio Ingresado con exito");
                    $('#Edificionuevo').modal('hide');
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
function agregaFormEdificio(datos) {
    d = datos.split('||');
    $('#cod_edifU').val(d[0]);
    $('#nombre_edifC').val(d[1]);
    $('#nombre_edifU').val(d[1]);
    $('#num_pisosU').val(d[2]);
    $('#sedeU').val(d[3]);
}

function actualizarEdificio() {
    cod_edifU = $('#cod_edifU').val();
    nombre_edifC = $('#nombre_edifC').val();
    nombre_edifU = $('#nombre_edifU').val();
    num_pisosU = $('#num_pisosU').val();
    sedeU = $('#sedeU').val();
    if (nombre_edifU.trim() == '') {
        alertify.alert('Entrada invalida', 'El edificio debe tener un nombre');
        $('#nombre_edifU').focus();
    } else if (nombre_edifU.length > 30) {
        alertify.alert('Entrada invalida', 'El nombre del edificio debe contener maximo 30 caracteres');
        $('#nombre_edifU').focus();
        return false;
    } else if (num_pisosU < 0 || num_pisosU.trim() == '') {
        alertify.alert('Entrada invalida', 'El numero de pisos debe ser mayor a 0');
        $('#num_pisosU').focus();
        return false;
    } else if (sedeU.trim() == '') {
        alertify.alert('Entrada invalida', 'El edificio debe tener una sede');
        $('#sedeU').focus();
        return false;
    } else if (sedeU.length > 30) {
        alertify.alert('Entrada invalida', 'La sede debe tener maximo 30 caracteres');
        $('#sedeU').focus();
        return false;
    } else {
        cadena = "cod_edifU=" + cod_edifU +
            "&nombre_edifC=" + nombre_edifC +
            "&nombre_edifU=" + nombre_edifU +
            "&num_pisosU=" + num_pisosU +
            "&sedeU=" + sedeU;
        $.ajax({
            type: "POST",
            url: "../app/Validadores/ValidadorEdificio.php",
            data: cadena,
            success: function (r) {
                if (r == 1) {
                    $('#edificios').load('../gestores/gestor-edificios.php');
                    alertify.success("Edificio actualizado con exito");
                    $('#Edificioeditar').modal('hide');
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
function preguntarSiNoEdif(cod_edif) {
    alertify.confirm('Eliminar datos', '¿Esta seguro de eliminar este registro?',
        function () { eliminarEdificio(cod_edif) }
        , function () { alertify.error('Operacion cancelada') });

}
function eliminarEdificio(cod_edif) {
    cadena = "cod_edifE=" + cod_edif;
    $.ajax({
        type: "POST",
        url: "../app/Validadores/ValidadorEdificio.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                $('#edificios').load('../gestores/gestor-edificios.php');
                alertify.success("Edificio eliminado con exito");
            } else {
                alertify.error(r);
            }
        }
    });
}

