<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/rsticket/componentes/config.php');

ControleDeAcesso::permitirAcesso(array(ControleDeAcesso::$TecnicoADM));

include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/componentes/script.php");

echo"<div class='sub_menu_principal'>";
echo FormComponente::actionButton('<img src="./css/images/new_ocorrencia.png" title="Novo Problema"  >','cadastrar/MeuProblema');
Texto::criarTitulo("Problemas");
echo "</div>";

$busca = new Busca();

$busca->validarPost($_POST);

?>
<form action="" method="post">
<fieldset>
	<legend>Pesquisar Problema</legend>
<table border="0">
 
	<tr>	
		<td>
			Departamento:
			<?php 
		       $tbdepartamento = new TbDepartamento();
		       FormComponente::$name = 'Todos';
		       FormComponente::selectOption('dep_codigo',$tbdepartamento->listarTodosDepartamentos(),true,$busca->getDados('dep_codigo'));
			?>
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


Arquivo::includeForm();



$tbproblema = new TbProblema();
$datagrid = new DataGrid(array('Problema','Departamento','Prioridade'),$busca->listarProblema());
$datagrid->colunaoculta = 1;
$datagrid->acao = 'alterar/MeuProblema';
$datagrid->mostrarDatagrid();


Sessao::finalizarSessao();

include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/menuadministrativo.php");
include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/componentes/rodape.php");
?>