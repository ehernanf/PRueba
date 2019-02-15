/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function() {
    $('#btn_config').click(function() {
        config();
    });

    function config() {
        var tipoWifi = $('#wificonf').val();
        _config(tipoWifi);
    }

    function _config(tipo) {

        if (confirm('ATENCIÓN. Esta seguro que quiere realizar esta operación?')) {
            var btn = $("#btn_config");
            btn.button('loading');
            var oOptions = {
                type: 'GET',
                url: CI.base_url + 'task/configwifi/' + tipo,
                dataType: 'json',
                beforeSend: function() {
                    btn.button('loading');
                }
            };
            var posting = $.ajax(oOptions);

            posting.done(function(response, textStatus, jqXHR) {
                var data = response.data;
                if (data !== null) {
                    if (data.success) {
                        alert('Actualización exitosa');
                    }
                } else {
                    alert('No se pudo establecer la configuración');
                }
                btn.button('reset');
            }).fail(function(response, textStatus, jqXHR) {
                alert('Conexión a internet inestable. Intentelo nuevamente.');
                btn.button('reset');
            });
        }
    }
});
