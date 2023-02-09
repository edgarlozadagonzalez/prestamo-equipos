function agregarFacultad(nombre_fac) {
    var nombre_fac = $('#nombre_fac').val();
    if (nombre_fac.trim() == '') {
        alertify.alert('Entrada invalida', 'Debe ingresar la facultad');
        $('#nombre_fac').focus();
        return false;
    } else if (nombre_fac.length > 30) {
        alertify.alert('Entrada invalida', 'La facultad debe contener maximo 30 caracteres');
        $('#nombre_fac').focus();
        return false;
    } else {
        cadena = "nombre_fac=" + nombre_fac;
        $.ajax({
            type: 'POST',
            url: '../app/Validadores/ValidadorFacultad.php',
            data: cadena,
            success: function (r) {
                console.log(r);
                if (r == 1) {
                    $('#facultades').load('../gestores/gestor-facultades.php');
                    alertify.success("Facultad Ingresada con exito");
                    $('#Facultadnueva').modal('hide');
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
function agregaFormFacultad(datos) {
    d = datos.split('||');
    $('#cod_facU').val(d[0]);
    $('#nombre_facU').val(d[1]);
}

function actualizarFacultad() {
    cod_facU = $('#cod_facU').val();
    nombre_facU = $('#nombre_facU').val();
    if (nombre_facU.trim() == '') {
        alertify.alert('Entrada invalida', 'Debe ingresar la facultad');
        $('#nombre_facU').focus();
        return false;
    } else if (nombre_facU.length > 30) {
        alertify.alert('Entrada invalida', 'La facultad debe contener maximo 30 caracteres');
        $('#nombre_facU').focus();
        return false;
    } else {
        cadena = "cod_facU=" + cod_facU +
                 "&nombre_facU=" + nombre_facU;
        $.ajax({
            type: "POST",
            url: "../app/Validadores/ValidadorFacultad.php",
            data: cadena,
            success: function (r) {
                if (r == 1) {
                    $('#facultades').load('../gestores/gestor-facultades.php');
                    alertify.success("Facultad actualizada con exito");
                    $('#Facultadeditar').modal('hide');
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
function preguntarSiNoFac(cod_fac) {
    alertify.confirm('Eliminar datos', '¿Esta seguro de eliminar este registro?',
        function () { eliminarFacultad(cod_fac) }
        , function () { alertify.error('Operacion cancelada') });

}
function eliminarFacultad(cod_fac) {
    cadena = "cod_facE=" + cod_fac;
    $.ajax({
        type: "POST",
        url: "../app/Validadores/ValidadorFacultad.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                $('#facultades').load('../gestores/gestor-facultades.php');
                alertify.success("Facultad eliminada con exito");
            } else {
                alertify.error(r);
            }
        }
    });
}