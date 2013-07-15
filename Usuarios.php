<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/rsticket/componentes/config.php');

include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/componentes/script.php");

echo"<div class='sub_menu_principal'>";
echo FormComponente::actionButton('<img src="./css/images/new_usuario.png" title="Novo Usuário"  >','cadastrar/usuario');
Texto::criarTitulo('Usuários');
echo "</div>";

?>

<?php

Arquivo::includeForm();

$tbusuario = new TbUsuario();

$datagrid = new DataGrid(array('Usuário','Departamento','Tipo de Acesso'),$tbusuario->selectUsuarios());
$datagrid->colunaoculta = 1;

$datagrid->islink2 = true;
$datagrid->nomelink2 = '<img src="./css/images/edit_password.png" title="Alterar Senha">';
$datagrid->acao2 = 'alterar/SenhaUsuario';


$datagrid->nomelink = '<img src="./css/images/editar.gif" title="Alterar Usuário">';
$datagrid->acao = 'alterar/usuario';

$datagrid->mostrarDatagrid();

Sessao::finalizarSessao();

include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/menuadministrativo.php");
include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/componentes/rodape.php");
?>