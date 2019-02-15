/*
 *
 */
//$(window).load(function(e) {
//    
//    var codigo_caja = $.trim($("#paulas").val());
//    if(codigo_caja <= 0){ 
//        $("#paulas").focus(); 
//    }   else{
//          $("#ins_numdoc").focus(); 
//    }
//    
//
//});

/*function cerrar_caja(cod_sede,cod_caja){
    alert('jajajaj');
}
*/

function cerrar_caja(cod_sede,cod_caja){

        var peso = $.trim($('#txtPeso').val());
       
       if((peso == "") || (peso<=0)){
           alert('PESO NO VALIDO');
           $('#txtPeso').focus();
           return false;
       }
       //alert('eee');
       
       var url=CI.base_url + 'paquete/cerrar_caja';

       if(confirm('EL PESO INGRESADO ES CORRECTO??')){
        
            $.ajax({ 
                url: url,
                type: 'GET', 
                async: false,
                dataType: 'json',
                data: {'cod_sede' : cod_sede,'cod_caja':cod_caja,'peso': peso},

                success: function(data){
                    //alert(result[0]);                    
                    if(data['exito'] == '1'){
                        $('#modalMessage').modal('hide');
                        alert('ACTUALIZACIÓN EXITOSA');
                        //document.location.href = CI.base_url + 'paquete?txtSede=' +cod_sede;
                        document.location.href = CI.base_url + 'paquete';

                       // location.reload();
                    }else{
                        if(data['exito'] == '2'){
                            $('#modalMessage').modal('hide');
                            alert('ACTUALIZACIÓN EXITOSA\nSEDE INVENTARIADA COMPLETAMENTE!!!');
                            //document.location.href = CI.base_url + 'index/sedes';
                            document.location.href = CI.base_url + 'paquete';
                        }else{
                            alert('NO SE PUDO TRANSFERIR EL REGISTRO');
                        }
                    }                                
                }            
            });       
       }else{
            $('#txtPeso').focus();
       }

 }
 function borrar_caja(cod_caja){

   //alert('eee');
   
   var url=CI.base_url + 'paquete/borrar_caja';

   if(confirm('¿Desea eliminar esta caja?')){
    
        $.ajax({
            url: url,
            type: 'get', 
            async: true,
            data: {'cod_caja': cod_caja},
            error: function(xhr, textStatus, error){
                alert(xhr.statusText);
                alert(textStatus);
                alert(error);
            },
            success: function(data){
                  alert('Se eliminó la caja seleccionada');
                  location.reload()
            }            
        });       
   }else{
        $('#txtPeso').focus();
   }

}
function agregar_caja(){

    //alert('eee');
    
    var url=CI.base_url + 'paquete/agregar_caja';
    if($('#sede_operativa').val()==0){
        alert('Debe elegir una sede operativa');
    }
    else
    {    if(confirm('¿DESEA AGREGAR UNA CAJA?')){
        
            $.ajax({
                url: url,
                type: 'get', 
                async: true,
                data: {
                    'sede_operativa': $('#sede_operativa option:selected').text(),
                    'cod_so': $('#sede_operativa').val()
                    },
                error: function(xhr, textStatus, error){
                    alert(xhr.statusText);
                    alert(textStatus);
                    alert(error);
                },
                success: function(data){
                    alert('¡Correcto! La creación de caja fue con éxito');
                    $('#caja_value').html('N° DE CAJA GENERADA: <BR/><span id="caja_generated">'+data+'</span>')
                    $('#agregar-caja').hide()
                    $('#txtCaja').focus()
                    $('#frmauladirector').submit(function(e){
                        e.preventDefault();
                        codigo_generado=parseInt(data);
                        codigo_buscado=parseInt($('#txtCaja').val());
                        console.log(codigo_generado);
                        console.log(codigo_buscado)
                        if(codigo_generado!=codigo_buscado){
                            alert('El codigo ingresado debe ser igual al código de la caja generada')
                            $('#txtCaja').val('');
                            $('#txtCaja').focus();
                            
                        }
                        else{
                            $(this).unbind('submit').submit()
                        }
                    })
                }            
            });       
        }else{
            $('#txtPeso').focus();
        }}
 
 }
$(document).ready(function(){
    
    if($("#txtCaja").val() == ""){
        console.log('1');

         setTimeout(function(){

            $("#txtCaja").focus();

        }, 1);
        
         
    }else{
        console.log('2');
        $("#buscarcaja").disable=false
        if($("#txtCodPaquete").val() == ""){
            console.log('3');
            setTimeout(function(){
            $("#txtCodPaquete").focus();  
        }, 1);
            
            
        }
    }
    carga_sede_operativa()
});

function carga_sede_operativa(){
    var url=CI.base_url + 'paquete/listar_sede';
    $.ajax({
        url: url,
        async: true,
        dataType: 'json',
        error: function(xhr, textStatus, error){
            alert(xhr.statusText);
            alert(textStatus);
            alert(error);
        },
        success: function(data){
            console.log(data)
            html='<option value="">--Seleccione--</option>'
            for(i=0;i<data.length;i++){
                html+='<option value="'+data[i].COD_SEDE+'">'+data[i].SEDE+'</option>'
            }
            $('#sede_operativa').html(html)
        }
    })
}

function nuevo(){
    $("#opcion").val("nuevo");
    $('#frmauladirector').submit();
}

function boton_caja(){
     //$("#opcion").val('cod_caja');  
     //$('#frmauladirector').submit();
//     alert($("#opcion").val());
//     return;

     var codigo_caja = $.trim($("#paulas").val());
    if(codigo_caja > 0){     
        $('#frmauladirector').submit();
    }else{
        alert("ingrese el codigo de la caja");
    }
}

function boton_paquete(e){
    e.preventDefault();
     var codigo_caja = $.trim($("#txtCaja").val());
    if(codigo_caja > 0){     
        
        var codigo_paquete = $.trim($("#txtCodPaquete").val());
        if(codigo_paquete === "" ){
            alert("ingrese el codigo de paquete");
        }else{
            if(confirm('¿Desea agregar el paquete '+codigo_paqute+'  a la caja '+codigo_caja+'?')){
            $('#frmauladirector').submit();}
            else{
                return;
            }
        }
    }else{
        alert("ingrese el codigo de la caja");
    }
//     alert($("#opcion").val());
//     return;
}

$(function() {
    //transfer_ua();

//    function transfer_ua() {
//        
//       
//        var dni = $("#ins_numdoc_id").val();
//        var nro_local = $("#nro_local_id").val();
//        var estado = $("#estado_id").val();
//         var codigo = $("#codigo_id").val();
//      
//        if (dni !== undefined && nro_local !== undefined && estado === '1') {
//          
//           _transfer_ua(codigo,dni,'2',nro_local);
//            
//            
//        }
//    }
//    
  

//    function _transfer_ua(codigo,dni,evento,nro_local) {
//      
//        var mensaje = $('#transf_id');
//        var oOptions = {
//            type: 'GET',
//            url: CI.base_url + 'task/transfer_u/?key='+codigo+'&ins_numdoc='+dni+'&nro_local='+nro_local+'&evento='+evento+'&cant_ficha=0',
//            
//            dataType: 'json',
//            beforeSend: function() {
//                
//                
//                mensaje.parent().addClass('alert-success');
//                mensaje.text('Sincronizando con monitoreo-Sede Central...');
//            }
//        };
//        var posting = $.ajax(oOptions);
//        
//        posting.done(function(response, textStatus, jqXHR) {
//            var data = response.data;
//        
//   }); }

   $("#ins_numdoc").focus();
 

});