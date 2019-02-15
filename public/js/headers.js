// JavaScript Document
var oTable;

$( document ).ready(function() {
});

function setCartera(carteraId, cartera) {
//	$('#cartera').html("Carteras: " + cartera);
	$.get("../user/setCarteraId/"+carteraId+"/"+cartera, function(data, status){
		$("#areaCartera").load(location.href + " #areaCartera");
		setCampania(-1, "");
		limpiarForms();
    });
}

function setCampania(campaniaId, campania) {
//	$('#campania').html("Campa\u00f1as: " + campania);
	$.get("../user/setCampaniaId/"+campaniaId+"/"+campania, function(data, status){
		$("#areaCampania").load(location.href + " #areaCampania");
		if ( $('#dt_basic').length ) {
			$('#dt_basic').DataTable().ajax.reload();
		}
	});
}



