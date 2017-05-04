<?php
header('Content-Type: application/json');

$arrResponse = array();
$arrResponse['status'] = 'error';

	// Check for empty fields
	if(empty($_POST['name'])  	||
	  empty($_POST['email']) 		||
	  empty($_POST['subject']) 	||
	  empty($_POST['message'])	||
	  !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
			$arrResponse['error_msg'] = 'Faltan parámetros';
			echo json_encode($arrResponse);
			die();
	 	}

	$arrResponse['status'] = 'ok';
		
	$name = $_POST['name'];
	$email_address = $_POST['email'];
	$subject = $_POST['subject'];
	$message = $_POST['message'];
		
	// Create the email and send the message
	$to = 'ignacio.perezroca@gmail.com,info@@camaraargentinacafe.com.ar'; // Add your email address yourname@yourdomain.com - This is where the form will send a message to.
	$email_subject = "Website Camara Argentina del Cafe:  $name";
	$email_body = "Recibiste una nueva consulta \n\n"."Formulario de Contacto:\n\nNombre: $name\n\nE-mail: $email_address\n\nAsunto: $subject\n\nMensaje:\n$message";
	$headers = "From: noreply@camaraargentinacafe.com.ar\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
	$headers .= "Reply-To: $email_address";
	
	if(!mail($to,$email_subject,$email_body,$headers))
	{
		$arrResponse['status'] = 'error';
		$arrResponse['error_msg'] = 'No se pudo enviar el email';
	}
	echo json_encode($arrResponse);
	die();

?>


