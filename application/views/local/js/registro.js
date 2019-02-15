/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready( function(){

    $('#psede').change(function(){
        $('#chofer').removeAttr('required')
        $('#placa').removeAttr('required')
        $('#representanteINEI').removeAttr('required')
        
        
       $('#frmdirector_id').submit(); 
    });
//    $("#btnAgregar").click(function(){                
//        $('#chofer').prop('required',true)
//        $('#placa').prop('required',true)
//        $('#representanteINEI').prop('required',true)
//        alert('');
//        $('#frmdirector_id').submit(); 
//    });
   /*
$("#btnAgregar").click(function(){
    var chofer=$("#chofer").val();
    var placa=$("#placa").val();;
    var inei=$("#inei").val();
    //var fecha=$("#fecha").val();
     //alert(fecha);
    data=chofer+"/"+placa+"/"+inei;
        
        var url=CI.base_url + 'task/guardadolocal2/'+data;
        console.log(url);
          //alert(url);
        var oOptions = {
            type: 'GET',            
            url: url,   
            contentType: "application/x-www-form-urlencoded;charset=UTF-8",
            beforeSend: function () {
                //$("#span_"+ids).html("Grabando .....");
            },
            success:  function (response) {      
                location.reload();
                
            },error:function(){
                location.reload();
            }         
        };
        var posting = $.ajax(oOptions);

 //alert(url);
   
})


*/
}); 

function _transfer(event) {
    
    //alert("caso");
    $('#tb_transporte tr[class="bg-danger"]').each(function(){
        //alert("caso");
        var cod_sede=$(this).children("#cod_sede").html();
        //alert(ruta);
//        alert(cod_sede);
        guardar(cod_sede);
    
    });
    
    /*$('#lista tr[pintame="1"]').each(function(){
        var ids=$(this).attr("id");
        ids=ids.replace('pintame_', "");
        var check=$("input[name='realizado_"+ids+"']:checked").val();
        var text=$("#txt_"+ids).val();
      
        var id_superv=$('#id_superv').val();
        var id_funcion=ids;
        if(check==='2'&&text===''){
            alert("Debe ingresar la observación de la funcion "+ id_funcion.replace("_",".") +" para poder grabar.");
            return;
        }
        guardar(id_superv,id_funcion,ids);
        
    });*/
}

function guardar(cod_sede){
   //alert("wfrwet");
     //var mensaje = $('#transf_id');
    //var url=CI.base_url + 'task/transfer_u/?id_superv=' + id_superv + '&id_funcion=' + id_funcion + '&ind_realizado=' + ind_realizado + '&obs=' + obs + '&estado='+estado+'';
    var url=CI.base_url + 'task/transfer_u2/?cod_sede=' + cod_sede ;
    //alert(url);
    
    console.log(url);
    var oOptions = {
        type: 'GET',
        url: url,
        dataType: 'json',
//        beforeSend: function () {
//            mensaje.parent().addClass('alert-success');
//            mensaje.text('Sincronizando con monitoreo-Sede Central...');
//        },
        success:  function (response) {
                //$('#tb_incidencias td')
                //$('#linea_'+$id_incidencia).addClass("bg-success")
                /*$('#pintame_'+ids).attr('pintame','2');
                setTimeout(function(){ 
                    $('#pintame_'+ids).addClass("success");
                }, 500);*/
            alert('Se actualizo correctamente');
            location.reload();
        },
        error: function(){
            alert('Se produjo un error al transferir la informacion');
            location.reload();
        }
        
    };
    var posting = $.ajax(oOptions);

    posting.done(function (response, textStatus, jqXHR) {
        var data = response.data;

    });
};


