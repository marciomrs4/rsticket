<?php 
$tbsolicitacao = new TbSolicitacao();

$dados = $tbsolicitacao->getFormAssentamento(base64_decode($_SESSION['valorform']));


?>

<form name="cadastrar/Assentamento" id="Assentamento" enctype="multipart/form-data" method="post" action="../<?php echo($_SESSION['projeto']); ?>/action/assentamento.php">
<fieldset>
	<legend><b>Assentamento</b></legend>
  <table width="300" border="0">
    <tr>
      <td colspan="2">	
      <?php Texto::mostrarMensagem($_SESSION['erro']);?>
    </td>
    </tr>

    <tr>
      <th nowrap="nowrap">Descrição da Atividade:</th>
      <td>
      	<?php echo($dados[1]); ?>
      </td>
    </tr>    
    
    <tr>
      <th nowrap="nowrap">Assentamento:</th>
      <td>
      <textarea name="ass_descricao" cols="55" rows="7"	><?php echo($_SESSION['cadastrar/Assentamento']['ass_descricao']); ?></textarea> 
      <input type="hidden" name="sol_codigo" value="<?php echo($dados[0]); ?>">	
      </td>
    </tr>
    <tr>
      <th nowrap="nowrap">Status do Chamado:</th>
      <td>
      <?php 
      	$tbstatus = new TbStatus();
      	FormComponente::selectOption('sta_codigo', $tbstatus->selectStatusNaoAberto(),false,$dados[2]);
      ?>
	  </td>
    </tr>    
    <tr>
      <th nowrap="nowrap">Atendente do Chamado:</th>
      <td>
      <?php 
      	$tbatendente = new TbAtendenteSolicitacao();
      	$atendente = $tbatendente->getNomeAtendente($dados[0]);
    
      	$tbusuario = new TbUsuario();
      		#Verifica se há um atendente e não houver, é mostrado o $name
      		#Caso contrario lista os nomes sem o $name
     	  	if($atendente)
   			{$valor = false;}
   			else
   			{FormComponente::$name = 'Não há atendentes';
   			$valor = true;}
      	FormComponente::selectOption('usu_codigo_atendente',$tbusuario->selectUsuarioDep($_SESSION['dep_codigo']),$valor,$atendente);
      
      ?>
	  </td>
    </tr>        
    <tr>
      <td colspan="2" align="center">
	      <input type="submit" name="alterar" value=" Salvar " />
	  </td>
    </tr>
  </table>
</form>
<hr>
  	<?php 
  	try
  	{
	  	$tbassentamento = new TbAssentamento();
	  	$tabela = $tbassentamento->listarAssentamento($dados[0]);
	
	  	$cabecalho = array('Descrição','Data','Editor');
	  	
	  	$grid = new DataGrid($cabecalho, $tabela);
	  	
	  	$grid->titulofield = 'Assentameto(s)';
	  	$grid->islink = false;
	  	$grid->colunaoculta = 1;
	  	$grid->mostrarDatagrid();
	  	
  	}catch (Exception $e)
  	{
  		echo $e->getMessage();
  	}
  	?>
 </fieldset>
<?php 
unset($_SESSION['cadastrar/Assentamento']);?>