<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/rsticket/componentes/config.php');

$ControleAcesso = new ControleDeAcesso();
$ControleAcesso->permitirAcesso(array(ControleDeAcesso::$TecnicoADM));

include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/componentes/script.php");

#Instancia a a classe busca 
$busca = new Busca();
#Seta a variavel GET e diz que pode ser usado o nome che_codigo
#para obetela
$busca->setValueGet($_GET,'che_codigo');
#Obtem o código che_codigo com metodo get


$tbchecklist = new TbChecklist();

$dados = $tbchecklist->getForm($busca->getValueGet('che_codigo'));

echo"<div class='sub_menu_principal'>";
echo FormComponente::actionButton('<img src="./css/images/ck.png" title="Novo Chamado"  >','cadastrar/ItemChecklist');
Texto::criarTitulo('Item Checklist');
echo "</div>";
?>
<fieldset><legend>Criando Checklist</legend>
Nome: <?php echo($dados['che_titulo']);?>

</fieldset>


<?php

Arquivo::includeForm();


Sessao::finalizarSessao();

include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/menuadministrativo.php");
include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/componentes/rodape.php");

?>