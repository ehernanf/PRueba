
$(document).ready(function(){
   // alert("sdasd");
   $('#tprincipal tr td img').click(function(){
       var idss=$(this).attr('ids');
       var url=CI.base_url + 'listar/reporte_cajas_faltantes/'+idss;
        console.log(url);
        $.ajax({
            url: url,
            type: 'GET', 
            dataType: 'json',
            success: function(data){
                //alert(result[0]);
                //onsole.log(result);
                var html="";                
                $.each(data, function(i, item) {
                    var orden=i+1;
                    html+="<tr style='font-size:13px;'><td>"+orden+"</td><td>"+item.CODIGO_BARRA+"</td><td style='text-align: left;'>"+item.NOMBRE_LOCAL+"</td><td>"+item.tipo+"</td></tr>"
                    //alert(item.ins_numdoc);
                });
                $("#nopistola tbody").html(html);
            }
        });
       
   });
   
   
   $('#t_locales tr td img').click(function(){
       var idss=$(this).attr('ids');
       var url=CI.base_url + 'listar/reporte_cajas_faltantes_local/'+idss;
        console.log(url);
        $.ajax({
            url: url,
            type: 'GET', 
            dataType: 'json',
            success: function(data){
                //alert(result[0]);
                //onsole.log(result);
                var html="";                
                var link = "";
                var ruta = $('#ruta').val();
                $.each(data, function(i, item) {
                    var orden=i+1;
                    // alert(item.ESTADO);
                    if(item.ESTADO == '1'){
                        link = '<label><small><img src="'+ ruta +'public/img/inventariado.png" style="width:25px" alt="Caja inventariada" title="Caja inventariada"/></small></label>';
                    }else{
                        if(item.ESTADO == '7'){
                            link = '<label><small><img src="' +ruta +'public/img/enviado.png" style="width:25px" alt="Caja transferida" title="Caja transferida" /></small></label>';
                        }else{
                            link = "";
                        }
                    }
                    
                    html+="<tr style='font-size:13px;'><td>"+orden+"</td><td>"+item.CODIGO_BARRA+"</td><td style='text-align: left;'>"+item.tipo+"</td><td>"+link+"</td></tr>"
                    //alert(item.ins_numdoc);
                });
                $("#nopistola tbody").html(html);
            }
        });
       
   });
   
   
   
});



