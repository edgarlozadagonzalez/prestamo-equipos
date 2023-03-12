function agregarSala() {
    var nombre_sal = $('#nombre_sal').val();
    var num_piso = $('#num_piso').val();
    var plataforma = $('#plataforma').val();
    var cod_edif = $('#cod_edif').val();
    if (nombre_sal.trim() == '') {
        alertify.alert('Entrada invalida', 'La sala debe tener un nombre');
        $('#nombre_sal').focus();
        return false;
    } else if (nombre_sal.length > 30) {
        alertify.alert('Entrada invalida', 'El nombre debe contener maximo 30 caracteres');
        $('#nombre_sal').focus();
        return false;
    } else if (plataforma.length > 30) {
        alertify.alert('Entrada invalida', 'La plataforma debe contener maximo 30 caracteres');
        $('#plataforma').focus();
        return false;
    } else if (cod_edif < 1) {
        alertify.alert('Entrada invalida', 'La sala debe estar en algun edificio');
        $('#num_piso').focus();
        return false;
    } else if (num_piso < 1) {
        alertify.alert('Entrada invalida', 'La sala debe estar en algun piso');
        $('#num_piso').focus();
        return false;
    } else {
        cadena = "nombre_sal=" + nombre_sal +
            "&num_piso=" + num_piso +
            "&plataforma=" + plataforma +
            "&cod_edif=" + cod_edif;
        $.ajax({
            type: 'POST',
            url: '../app/Validadores/ValidadorSala.php',
            data: cadena,
            success: function (r) {
                console.log(r);
                if (r == 1) {
                    $('#salas').load('../gestores/gestor-salas.php');
                    alertify.success("Sala Ingresada con exito");
                    $('#Salanueva').modal('hide');
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
function agregaFormSala(datos) {
    d = datos.split('||');
    $('#cod_salU').val(d[0]);
    $('#nombre_salC').val(d[1]);
    $('#nombre_salU').val(d[1]);
    $('#plataformaU').val(d[2]);
    $('#cod_edifU').val(d[3]);
    $('#num_pisoU').val(d[4]);
}

function actualizarSala() {
    cod_salU = $('#cod_salU').val();
    nombre_salC = $('#nombre_salC').val();
    nombre_salU = $('#nombre_salU').val();
    num_pisoU = $('#num_pisoU').val();
    plataformaU = $('#plataformaU').val();
    cod_edifU = $('#cod_edifU').val();
    if (nombre_salU.trim() == '') {
        alertify.alert('Entrada invalida', 'La sala debe tener un nombre');
        $('#nombre_salU').focus();
        return false;
    } else if (nombre_salU.length > 30) {
        alertify.alert('Entrada invalida', 'El nombre debe contener maximo 30 caracteres');
        $('#nombre_salU').focus();
        return false;
    } else if (plataformaU.length > 30) {
        alertify.alert('Entrada invalida', 'La plataforma debe contener maximo 30 caracteres');
        $('#plataformaU').focus();
        return false;
    } else if (cod_edifU < 1) {
        alertify.alert('Entrada invalida', 'La sala debe estar en algun edificio');
        $('#num_pisoU').focus();
        return false;
    } else if (num_pisoU < 1) {
        alertify.alert('Entrada invalida', 'La sala debe estar en algun piso');
        $('#num_pisoU').focus();
        return false;
    } else {
        cadena = "cod_salU=" + cod_salU +
            "&nombre_salC=" + nombre_salC +
            "&nombre_salU=" + nombre_salU +
            "&num_pisoU=" + num_pisoU +
            "&plataformaU=" + plataformaU +
            "&cod_edifU=" + cod_edifU;
        $.ajax({
            type: "POST",
            url: "../app/Validadores/ValidadorSala.php",
            data: cadena,
            success: function (r) {
                if (r == 1) {
                    $('#salas').load('../gestores/gestor-salas.php');
                    alertify.success("Sala actualizada con exito");
                    $('#Salaeditar').modal('hide');
                    if ($('.modal-backdrop').is(':visible')) {
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                    };
                } else {
                    console.log(cadena);
                    alertify.error(r);
                }
            }
        });
    }
}
function preguntarSiNoSal(cod_sal) {
    alertify.confirm('Eliminar datos', '¿Esta seguro de eliminar este registro?',
        function () { eliminarSala(cod_sal) }
        , function () { alertify.error('Operacion cancelada') });

}
function eliminarSala(cod_sal) {
    cadena = "cod_salE=" + cod_sal;
    $.ajax({
        type: "POST",
        url: "../app/Validadores/ValidadorSala.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                $('#salas').load('../gestores/gestor-salas.php');
                alertify.success("Sala eliminada con exito");
            } else {
                alertify.error(r);
            }
        }
    });
}


