$(document).ready(function() {

	$("#correoOK").hide();
	$("#userOK").hide();

	$("#campoEmail").change(function(){
		const campo = $("#campoEmail"); // referencia jquery al campo
		campo[0].setCustomValidity(""); // limpia validaciones previas

		// validación html5, porque el campo es <input type="email" ...>
		const esCorreoValido = campo[0].checkValidity();
		if (esCorreoValido && correoValidoComplu(campo.val())) {
			// el correo es válido y acaba por @ucm.es: marcamos y limpiamos quejas
		
			// tu código aquí: coloca la marca correcta
			$("#validEmail").show();
			$("#invalidEmail").hide();
			campo[0].setCustomValidity("");
		} else {			
			// correo invalido: ponemos una marca y nos quejamos

			// tu código aquí: coloca la marca correcta
			$("#validEmail").hide();
			$("#invalidEmail").show();
			campo[0].setCustomValidity(
				"El correo debe ser válido y acabar por @ucm.es");
		}
	});

	
	$("#campoUser").change(function(){
		var url = "comprobarUsuario.php?user=" + $("#campoUser").val();
		$.get(url,usuarioExiste);
  });


	function correoValidoComplu(correo) {
		return correo.endsWith("@ucm.es");
	}

	function usuarioExiste(data,status) {
		if (data === "existe") {
			$("#validUser").hide();
			$("#invalidUser").show();
			$("#campoUser")[0].setCustomValidity("El usuario ya existe");
			alert("El nombre de usuario ya está reservado");
		  } else {
			$("#validUser").show();
			$("#invalidUser").hide();
			$("#campoUser")[0].setCustomValidity("");
		  }
	}
})