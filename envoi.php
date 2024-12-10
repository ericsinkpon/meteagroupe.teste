<?php
	require './phpmailer/src/Exception.php';
	require './phpmailer/src/PHPMailer.php';
	require './phpmailer/src/SMTP.php';

	use Spipu\Html2Pdf\Html2Pdf;
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	
	$emailFrom = "noreply@conseilauto.ci";
	$emailFromName = "CONSEILAUTO";
	$objetmail = $_POST["message"]->objet;
	$messagebody = $_POST["message"]->body;

	$mail = new PHPMailer(true);
	try {
		// Server settings
		$mail->isSMTP();
		$mail->Host       = 'hosting';   // SMTP server
		$mail->SMTPAuth   = true;                  // Enable SMTP authentication
		$mail->Username   = 'noreply@mail.ci';   // SMTP username
		$mail->Password   = 'password';       // SMTP password
		$mail->SMTPSecure = 'tls';                 // Enable TLS encryption
		$mail->Port       = 587;                   // TCP port to connect to

		// Recipients
		$mail->setFrom($emailFrom, $emailFromName);
		$mail->addAddress(trim($_POST["message"]->saisieemail), "No Reply"); 

		// Content
		$mail->isHTML(true);
		$mail->CharSet = 'UTF-8'; // Set CharSet to UTF-8
		$mail->Subject = $objetmail;
		$mail->isHTML(true);
		$mail->msgHTML($messagebody);
		$mail->AltBody = 'HTML messaging not supported';

		// Send the email
		$mail->send();
	} catch (Exception $e) {
	}

	$data["status"] = 1;
	echo json_encode($data);
?>
