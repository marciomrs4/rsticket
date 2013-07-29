<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/rsticket/componentes/config.php');

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
			Departamento:
			<?php 
			$tbdepartamento = new TbDepartamento();	
			FormComponente::$name = 'TODOS';
		    FormComponente::selectOption('dep_codigo_busca',$tbdepartamento->listarDepartamentos(),true,$busca->getDados('dep_codigo_busca'));
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
		       FormComponente::$name = 'TODOS';
		       FormComponente::selectOption('pro_codigo_busca',$tbproblema->listarProblema('dep_codigo'),true,$busca->getDados('pro_codigo_busca'));
			?>
	
	<tr>
		<td>
			Solicitante:
				<input type="text" name="usu_nome" value="<?php echo($busca->getDados('usu_nome')); ?>">
		
			Descri��o:
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
	

$cabecalho = array('N�mero',$_SESSION['config']['problema'],'Status','Solicitante','Depto Solicitado','Descri��o','Atendente');

$dados = $busca->listarChamadoSolicitante();

$datagrid = new DataGrid($cabecalho,$dados);

$datagrid->titulofield = 'Chamado(s)';
$datagrid->acao = 'alterar/SolicitacaoSolicitante';
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