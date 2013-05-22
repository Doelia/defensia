<?php

function notif($sujet, $msg)
{
	$to      = 'kyxalia@gmail.com';
	$subject = $sujet;
	$message = $msg;
	$headers = 'From: support@survivia.net' . "\r\n" .
	'Reply-To: support@survivia.net' . "\r\n" .
	'X-Mailer: PHP/' . phpversion();

	@mail($to, $subject, $message, $headers);
}

