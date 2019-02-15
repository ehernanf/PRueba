/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function() {
    $('#btnEnviar_id').click(function() {
        transfer();
    });

    function transfer() {
        var event = $("#event_id").val();
        if (event !== '') {
            _transfer(event);
        } else {
            alert('Debe seleccionar un evento');
        }
    }

    function _transfer(event) {
        if (confirm('ATENCIÓN. Esta seguro que quiere realizar esta operación?')) {
            var btn = $("#btnEnviar_id");
            btn.button('loading');
            var oOptions = {
                type: 'GET',
                url: CI.base_url + 'task/transfer/' + event,
                dataType: 'json',
                data: {'mass' : true},
                beforeSend: function() {
                    btn.button('loading');
                }
            };
            var posting = $.ajax(oOptions);

            posting.done(function(response, textStatus, jqXHR) {
                var data = response;
                if (data !== null) {
                    if (data.success) {
                        alert('Actualización exitosa');
                    }
                } else {
                    alert('No se pudo transferir el registro');
                }
                btn.button('reset');
            }).fail(function(response, textStatus, jqXHR) {
                alert('Conexión a internet inestable. Intentelo nuevamente.');
                btn.button('reset');
            });
        }
    }
});
