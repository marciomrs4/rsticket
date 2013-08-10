<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/rsticket/componentes/config.php'); 



$tb = new TbSolicitacao();


echo $tb->getStatus(60);


// O remetente deve ser um e-mail do seu domínio conforme determina a RFC 822.
// O return-path deve ser ser o mesmo e-mail do remetente.

?>

