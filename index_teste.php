<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/rsticket/componentes/config.php'); 


echo ValidarCampos::retornarStatus(1, 'CORRETO', 'ERRADO FALSE');


// O remetente deve ser um e-mail do seu domínio conforme determina a RFC 822.
// O return-path deve ser ser o mesmo e-mail do remetente.

 ?>

