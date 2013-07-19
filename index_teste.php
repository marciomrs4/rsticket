<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/rsticket/componentes/config.php'); 

$email = new Email();

$email->cabecalho = 'E-mail de TESTE';

$email->para = 'marciomrs4@hotmail.com';

$email->mensagem = 'teste de envio';

$email->enviarEmail();

if($email->erro)
{
	echo "Messagem enviada com sucesso";
}else{
	echo "Erro ao enviar";
}


// O remetente deve ser um e-mail do seu domínio conforme determina a RFC 822.
// O return-path deve ser ser o mesmo e-mail do remetente.

 ?>

