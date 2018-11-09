function validarAlumno(){

	//aquí busca los elementos html del formulario
	var correo=$('#email_alumno').val();//expediente del alumno
	var comprobarCorreo=$('#confirmar_email_alumno').val();//Expediente
	var nombre=$('#nombre_alumno').val();

	var telefono=$('#celular_alumno').val();//Se invalida

	var input_folio=$('#folio');//Se invalida
	var vista_folio=$('#folio_alumno');//Se invalida
	var vista_usuario=$('#usuario_alumno');//Se invalida

	var folio;//Se invalida
	//para generar el folio usaré "INST" ó "ALUM"
	folio="ALUM";//Se invalida

	//seguido de los tres primeros números
	folio+=telefono.charAt(0);//Se invalida
	folio+=telefono.charAt(1);//Se invalida
	folio+=telefono.charAt(2);//Se invalida

	//seguido de las tres primeras letras de su nombre
	folio+=nombre.charAt(0);//Se invalida
	folio+=nombre.charAt(1);//Se invalida
	folio+=nombre.charAt(2);//Se invalida
	//alert("Su folio es: "+folio);
	input_folio.val(folio);//Se invalida


	//para formar la dirección ya que los campos están separados
	var calle=$('#calle').val();//Se invalida
	var colonia=$('#colonia').val();//Se invalida

	var domicilio_alumno="calle "+calle+" colonia "+colonia;//Se invalida

	var input_domicilio=$('#domicilio_alumno');//Se invalida
	input_domicilio.val(domicilio_alumno);//Se invalida

	if (correo==comprobarCorreo) {//Expediente del alumno
		alert("Sus datos están por ser registrados, cuando inicies sesión usa estos datos: USUARIO: "+correo+" CONTRASEÑA: "+folio);//Se invalida
		vista_usuario.val(correo);//Expediente
	    vista_folio.val(folio);//Contraseña
		document.form_alumno.submit();
	}
	else{
		alert("Los correos ingresados no coinciden, verifique");

	}


}

function OpenInNewTab($url) {
  var win = window.open($url, '_blank');
  win.focus();
}

function validarCorreo(){
	//aquí busca los campos del html y saca sus valores
	var correo=$('#email_instructor').val();
	var comprobarCorreo=$('#confirma_email_instructor').val();

	var nombre=$('#nombre_instructor').val();
	var telefono=$('#telefono_instructor').val();

	var input_folio=$('#folio');
	var folio;

	//para generar el folio usaré "INST" ó "ALUM"
	folio="INST";

	//seguido de los tres primeros números
	folio+=telefono.charAt(0);
	folio+=telefono.charAt(1);
	folio+=telefono.charAt(2);

	//seguido de las tres primeras letras de su nombre
	folio+=nombre.charAt(0);
	folio+=nombre.charAt(1);
	folio+=nombre.charAt(2);

	//alert("Su folio es: "+folio);
	input_folio.val(folio);

	//aquí forma la cadena de horario
	var horario;


	//aquí comprueba el correo, si son iguales se envía una instrucción submit y comienza a ejecutar el php
	if (correo==comprobarCorreo) {//expediente==
		alert("Sus datos están por ser registrados, cuando inicies sesión usa estos datos: USUARIO: "+correo+" CONTRASEÑA: "+folio);
		vista_usuario.val(correo);//Expediente
	    vista_folio.val(folio);//Password
		document.registro_profesor.submit();
	}
	else{//si los correos no coinciden entonces se manda un msj y no deja registrar
		alert("Los correos ingresados no coinciden, verifique");
		notificacion.html("Los correos ingresados no coinciden, verifique");
	}
}
