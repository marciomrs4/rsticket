<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/rsticket/componentes/config.php');

$ControleAcesso = new ControleDeAcesso();
$ControleAcesso->permitirAcesso(array(ControleDeAcesso::$TecnicoADM,ControleDeAcesso::$Tecnico));

include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/componentes/script.php");

$busca = new Busca();

$busca->validarPost($_POST);

echo"<div class='sub_menu_principal'>";
echo FormComponente::actionButton('<img src="./css/images/addchamado.png" title="Novo Chamado"  >','cadastrar/Solicitacao');
Texto::criarTitulo("Chamado");
echo "</div>";

?>
<form action="" method="post">
<fieldset>
	<legend>Pesquisar Chamado</legend>
<table border="0">
 
	<tr>	
		<td>
			Ver por:
			<?php 
			$tbverpor = new TbVerPor();
		    FormComponente::selectOption('verpor',$tbverpor->selectVerPor(),false,$busca->getDados('verpor'));
			?>
			Status:
			<?php 
			$tbstatus= new TbStatus();
			FormComponente::$name = 'TODOS';
			FormComponente::selectOption('sta_codigo', $tbstatus->selectMeuStatus(),true,$busca->getDados('sta_codigo'));
			?>

			<?php 
			echo($_SESSION['config']['problema'].':');
				
		    $tbproblema = new TbProblema();
		    FormComponente::$name = 'Todos';
		    FormComponente::selectOption('pro_codigo_busca',$tbproblema->listarProblema($_SESSION['dep_codigo']),true,$busca->getDados('pro_codigo_busca'));
			?>
	
	<tr>
		<td>
			Solicitante:
				<input type="text" name="usu_nome" value="<?php echo($busca->getDados('usu_nome')); ?>">
		
			Descrição:
				<input type="text" name="sol_descricao_solicitacao" size="50" value="<?php echo($busca->getDados('sol_descricao_solicitacao'));?>">
		</td>				

		<td>
			<input type="submit" value="Pesquisar" />
		</td>
	</tr>
</table>
</fieldset>
</form>
<br />

<?php

#Carrega dinamicamente os formularios	
Arquivo::includeForm();


try
{
	
$cabecalho = array('Número',$_SESSION['config']['problema'],'Status','Solicitante','Depto Solicitante','Descrição','Atendente','Data Abertura');

$dados = $busca->listarChamado();

$datagrid = new DataGrid($cabecalho,$dados);

$datagrid->titulofield = 'Chamado(s)';
$datagrid->acao = 'alterar/Solicitacao';
$datagrid->nomelink = '<img src="/rsticket/css/images/search.png" />';	

$datagrid->mostrarDatagrid();

}catch (Exception $e)
{
	echo $e->getMessage() . " ". $e->getCode();
}

Sessao::finalizarSessao();

include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/menusecundario.php");
include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/componentes/rodape.php");

?>