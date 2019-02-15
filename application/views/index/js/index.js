/*
 *
 */

$(document).ready(function () {
    $("#clave").focus();
//    $('#version b').text(Android.getApkVersion());
});

$(document).click(function () {
    $("#clave").focus();
});

function inventariar(valor){
    $('#txtSede').val(valor);
    $('#frm1').submit();
}