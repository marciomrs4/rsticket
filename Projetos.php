<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/rsticket/componentes/config.php');

ControleDeAcesso::permitirAcesso(array(ControleDeAcesso::$TecnicoADM));

include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/componentes/script.php");

echo"<div class='sub_menu_principal'>";
echo FormComponente::actionButton('<img src="./css/images/novo.png" title="Novo Projeto"  >','cadastrar/projeto');
Texto::criarTitulo("Projetos");
echo "</div>";

Arquivo::includeForm();

?>
<br/><br/><br/>
 
<div id="tabs">
  <ul>
    <li><a href="#tabs-1">Projetos em Andamento</a></li>
    <li><a href="#tabs-2">Projetos em Aprovação</a></li>
    <li><a href="#tabs-3">Projetos Cancelados</a></li>    
    <li><a href="#tabs-4">Projetos Concluídos</a></li>        
  </ul>
  <div id="tabs-1">
    <?php 
         $tbprojeto = new TbProjeto();

         $datagrid = new DataGrid(array('Código','Titulo','Descrição','Previsão Inicio','Previsão Fim','Usuário','Status'),
         							$tbprojeto->selectMeusProjetosAndamento($_SESSION['dep_codigo']));
         $datagrid->colunaoculta = 1;

         $datagrid->acao = 'alterar/projeto';

         $datagrid->mostrarDatagrid();
      ?>
  </div>
  <div id="tabs-2">
    <?php 
         $tbprojeto = new TbProjeto();

         $datagrid = new DataGrid(array('Código','Titulo','Descrição','Previsão Inicio','Previsão Fim','Usuário','Status'),
         							$tbprojeto->selectMeusProjetosAprovacao($_SESSION['dep_codigo']));
         $datagrid->colunaoculta = 1;
         
         $datagrid->nomelink = '<img src="./css/images/ap_project.png" width="32" height="32" title="Aprovar Projeto">';
		 $datagrid->link ='action/aprovarprojeto.php';
         $datagrid->acao = 'aprovar/projeto';

         $datagrid->islink2 = true;
         $datagrid->acao2 = 'alterar/projeto';
         $datagrid->nomelink2 = '<img src="./css/images/editar.gif" title="Alterar Projeto">';
         
         $datagrid->mostrarDatagrid();
      ?>
  </div>
  <div id="tabs-3">
    <?php 
         $tbprojeto = new TbProjeto();

         $datagrid = new DataGrid(array('Código','Titulo','Descrição','Previsão Inicio','Previsão Fim','Usuário','Status'),
         							$tbprojeto->selectMeusProjetosCancelados($_SESSION['dep_codigo']));
         $datagrid->colunaoculta = 1;
         
         $datagrid->acao = 'alterar/projeto';
         $datagrid->nomelink = '<img src="./css/images/editar.gif" title="Alterar Projeto">';
         
         $datagrid->mostrarDatagrid();
      ?>
  </div>  
  <div id="tabs-4">
    <?php 
         $tbprojeto = new TbProjeto();

         $datagrid = new DataGrid(array('Código','Titulo','Descrição','Previsão Inicio','Previsão Fim','Usuário','Status'),
         							$tbprojeto->selectMeusProjetosConcluidos($_SESSION['dep_codigo']));
         $datagrid->colunaoculta = 1;

         $datagrid->acao = 'alterar/projeto';
         $datagrid->nomelink = '<img src="./css/images/editar.gif" title="Alterar Projeto">';
         
         $datagrid->mostrarDatagrid();
      ?>
  </div>    
</div>

<?php
Sessao::finalizarSessao();

include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/menusecundario.php");
include($_SERVER['DOCUMENT_ROOT']."/{$_SESSION['projeto']}/componentes/rodape.php");

?>

