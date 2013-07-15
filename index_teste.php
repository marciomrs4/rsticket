<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/rsticket/componentes/config.php'); 

$mail = new Email();

$mail->mensagem = 'TESTE';

$mail->enviarEmail();

echo $mail->erro;

?>