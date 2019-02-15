$(function() {
    $("#btn-downApp").click(function() {
        var oOptions = {
            type: 'GET',
            url: CI.base_url + "updateApp/downApp",
            dataType: 'json'
        };
        var posting = $.ajax(oOptions);
        posting.done(function(response, textStatus, jqXHR) {
            var data = response.data;
            alert(data.mensaje);
            $("#result_update").html(data.mensaje);
        }).fail(function(data, textStatus, jqXHR) {
            alert('Conexión a internet inestable. Intentelo nuevamente.');
        });

    });

    $("#btn-updateApp").click(function() {
        var oOptions = {
            type: 'GET',
            url: CI.base_url + "updateApp/updApp",
            dataType: 'json'
        };
        var posting = $.ajax(oOptions);
        posting.done(function(response, textStatus, jqXHR) {
            var data = response.data;
            alert(data.mensaje);
            window.location.reload()
        }).fail(function(data, textStatus, jqXHR) {
            alert('Conexión a internet inestable. Intentelo nuevamente.');
        });


    });

});