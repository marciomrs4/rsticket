<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/rsticket/componentes/config.php');

$ControleAcesso = new ControleDeAcesso();
$ControleAcesso->permitirAcesso(ControleDeAcesso::$Executor);

include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/componentes/script.php");

$busca = new Busca();

$busca->setValueGet($_GET,'che_codigo');

$che_codigo = $busca->getValueGet('che_codigo');

echo"<div class='sub_menu_principal'>";
echo FormComponente::actionButton('<img src="./css/images/ck.png" title="Novo Chamado"  >','cadastrar/ItemChecklist');
Texto::criarTitulo('Item Checklist');
echo "</div>";



Arquivo::includeForm();


Sessao::finalizarSessao();

include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/menuadministrativo.php");
include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/componentes/rodape.php");

?>