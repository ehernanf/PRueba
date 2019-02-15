/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function _transfer(event) {
    
    if (confirm('ATENCIÓN. Esta seguro que quiere realizar esta operación?')) {
        var btn = $("#btnEnviar_id");
        btn.button('loading');
        var url=CI.base_url + 'task/transfer/' + event;
        //console.log(url);
        var oOptions = {
            type: 'GET',
            url: url,
            dataType: 'json',
            data: {'mass' : true},
            beforeSend: function() {
                $('#modalMessage').modal('show');
            }
        };
        var posting = $.ajax(oOptions);

        posting.done(function(response, textStatus, jqXHR) {
            var data = response;
            if (data !== null) {
                if (data.success) {                    
                    $('#modalMessage').modal('hide');
                    alert('Actualización exitosa');
                    //location.reload();
                }else{
                    if(data.sin_datos_actualizar){
                        $('#modalMessage').modal('hide');
                    }
                }
            } else {
                alert('No se pudo transferir el registro');
            }

        }).fail(function(response, textStatus, jqXHR) {
            $('#modalMessage').modal('hide');
            alert('Conexión a internet inestable. Intentelo nuevamente.');
        });
    }
}

function centerModals() {
    $('.modal').each(function(i) {
        var $clone = $(this).clone().css('display', 'block').appendTo('body');
        var top = Math.round(($clone.height() - $clone.find('.modal-content').height()) / 2);
        top = top > 0 ? top : 0;
        $clone.remove();
        $(this).find('.modal-content').css("margin-top", top);
    });
}
$('.modal').on('show.bs.modal', centerModals);
$(window).on('resize', centerModals);