function preguntarSiNoPersona(cod_per){
    alertify.confirm('Eliminar datos','¿Esta seguro de eliminar este registro?',
    function(){eliminarPersona(cod_per)}
    ,function(){alertify.error('Operacion cancelada')});

}
function eliminarPersona(cod_per){
    cadena="cod_perE=" + cod_per;
    $.ajax({
        type:"POST",
        url:"../app/Validadores/ValidadorPersona.php",
        data:cadena,
        success:function(r){
            if(r==1){
            $('#personas').load('../gestores/gestor-personas.php');
            alertify.success("Ṕersona eliminada con exito");
            }else{
                alertify.error(r);
            }    
        }
    });
}
