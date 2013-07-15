<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/rsticket/componentes/config.php');

include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/componentes/script.php");

echo"<div class='sub_menu_principal'>";
echo FormComponente::actionButton('<img src="./css/images/new_time.png" title="Novo Tempo de Atendimento">','cadastrar/MeuTempo');
echo FormComponente::actionButton('<img src="./css/images/novo.png" title="Nova Prioridade">','cadastrar/MinhaPrioridade');
Texto::criarTitulo("Prioridade / Tempo de Prioridade");
echo "</div>";

Arquivo::includeForm();

?>

<?php


$tbprioridade = new TbPrioridade();
$datagrid = new DataGrid(array('Descricao','Tempo de Atendimento'),$tbprioridade->selectMinhasPrioridades($_SESSION['dep_codigo']));
$datagrid->colunaoculta = 1;
$datagrid->acao = 'alterar/MinhaPrioridade';
$datagrid->nomelink = '<img src="./css/images/editar.gif" title="Alterar Prioridade">';
$datagrid->mostrarDatagrid();

?>
<hr/>

<?php 
$tbtempoatendimento = new TbTempoAtendimento();
$datagrid2 = new DataGrid(array('Tempo de Atendimento'), $tbtempoatendimento->selectMeuTempoAtendimento($_SESSION['dep_codigo']));
$datagrid2->colunaoculta = 1;
$datagrid2->acao = 'alterar/MeuTempo';
$datagrid2->nomelink = '<img src="./css/images/editar.gif" title="Alterar Tempo de Atendimento">';
$datagrid2->mostrarDatagrid();

Sessao::finalizarSessao();

include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/menuadministrativo.php");
include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/componentes/rodape.php");
?>