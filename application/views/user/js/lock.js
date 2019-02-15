$( document ).ready(function() {
	iniciarForm();
});

function iniciarForm() {
	login();
}
	
function login() {
	$('#btnLogin').click(function() {
		$.post($('#ubicacion').val(), {
			usuarioId:$('#usuarioId').val(),
			password:$('#password').val()
		}, function(data) {
			if(data.toString().trim() != 'OK') {
				$('#password').val("");
				return;
			}
			window.history.back();
		});
	});
}	