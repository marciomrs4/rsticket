<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/rsticket/componentes/config.php');

include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/componentes/script.php");

Texto::criarTitulo("Minhas Informa��es");

?>

<a href="../<?php echo $_SESSION['projeto'] ?>/action/formcontroler.php?<?php echo base64_encode('alterar/MinhaSenha')?>">Alterar Senha</a>

<a href="../<?php echo $_SESSION['projeto'] ?>/action/formcontroler.php?<?php echo base64_encode('alterar/MeuPerfilCor')?>">Alterar Perfil</a>
<hr />
<?php 
Arquivo::includeForm();

Sessao::finalizarSessao();

include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/menusecundario.php");
include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/componentes/rodape.php");

?>