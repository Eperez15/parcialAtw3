<?php

require ('PHPMailer/PHPMailerAutoload.php');

 $mail = new PHPMailer();

$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';
$mail->Host = 'smtp.gmail.com';
$mail->Port = '587';
$mail->Username = '';
$mail->Password = '';
$mail->SetFrom('', 'atwti');
$mail->addAddress($email, $name);

$mail->Subject = 'Registro de usuario';
$mail->Body = 'Bienvenido a ATWTI , usuario ha sido registrado correctamente';

if($mail->send()){
	echo 'Enviado correctamente';
	
}else{
	echo 'error de envio';
}










?>