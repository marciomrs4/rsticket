<?php 

include_once($_SERVER['DOCUMENT_ROOT'].'/rsticket/componentes/config.php'); 


//$mail = new PHPMailer();
 
$mail = new PHPMailer(); //instancia a classe
 
$mail->IsMail();//define função
 
//autenticação
$mail->Host = 'mail.staycorp.com.br';
$mail->SMTPAuth = true;
$mail->Username = 'marcio@staycorp.com.br';
$mail->Password = 'q1w2e3mrs@.$';
$mail->Port = '587';
 
$mail->IsHTML(true);
$mail->Subject = utf8_decode("Testando email!");//assunto do email
$mail->From = "marcio@staycorp.com.br";//email do remetente
$mail->FromName ='Márcio Ramos';//nome do remetente
 
$mail->Body = utf8_decode("Olá <strong>Fulano de Tal</strong>, você recebeu um email com anexo!");
$mail->AddAddress('marciomrs4@gmail.com');//email do destinatario
//$mail->AddAttachment('my_file.pdf');//anexa o arquivo
 
$verifica = $mail->Send();//envia o email
 
if($verifica){
    echo "Enviou";
}
else{
    echo "Não enviou!" . $mail->ErrorInfo;
}
?>