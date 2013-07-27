<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/rsticket/componentes/config.php');

$ControleAcesso = new ControleDeAcesso();

$ControleAcesso->permitirAcesso(array(ControleDeAcesso::$Tecnico,ControleDeAcesso::$TecnicoADM));

include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/componentes/script.php");

$busca = new Busca();

$busca->validarPost($_POST);


echo"<div class='sub_menu_principal'>";
Texto::criarTitulo('Checklist');
echo "</div>";
?>

<form name="verificarchecklist" action="" method="post">
<fieldset>
	<legend>Executar CheckList</legend>
<tr>
	<td>Selecione Checklist:
	</td>
	<td>
<?php 

$tbchecklist = new TbChecklist();
FormComponente::selectOption('che_codigo',$tbchecklist->listarExecucaoChecklist($_SESSION['dep_codigo']),true,$busca->getDados('che_codigo'));
?>
	</td>
</tr>
<input type="submit" class="button-tela" value="Executar">
</fieldset>
</form>
<hr/>
<?php 

$formcomponente = new FormComponente();

$formcomponente->objpdo = $busca->listarExecutarCheckList();

echo $_SESSION['erro'];

$formcomponente->montarFormularioCheckList($busca->getDados('che_codigo'));


Sessao::finalizarSessao();

include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/menusecundario.php");
include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/componentes/rodape.php");

?>