<?php 
$tbitemchecklist = new TbItemChecklist();

$_SESSION['itemchecklist'] = $tbitemchecklist->getForm(base64_decode($_SESSION['valorform']));

?>
<form name="itemchecklist" enctype="multipart/form-data" method="post" action="../rsticket/action/itemchecklist.php">
 
<fieldset>
	<legend>Cadastrar Tarefa</legend>
  <table width="300" border="0">
    <tr>
      <td colspan="2">
      <?php Texto::mostrarMensagem($_SESSION['erro']);?>
    </td>
    <tr>
      <td nowrap="nowrap">Tarefa:</td>
      <td>
      <input name="ich_titulo_tarefa" type="text" size="40" value="<?php echo $_SESSION['itemchecklist']['ich_titulo_tarefa']?>" />
      </td>
    </tr>
    <tr>
      <td nowrap="nowrap">Link:</td>
      <td>
      <input name="ich_link" type="text" size="40" value="<?php echo $_SESSION['itemchecklist']['ich_link']?>" />
      <input name="ich_codigo" type="hidden"  value="<?php echo $_SESSION['itemchecklist']['ich_codigo']?>" />      
      </td>
    </tr>
    <tr>
      <td nowrap="nowrap">Ativo:</td>
      <td>
      <?php 
      	$tbsn = new TbSimNao();
      	FormComponente::selectOption('ich_ativo', $tbsn->selectSimNao(),false,$_SESSION['itemchecklist']['ich_ativo']);
      ?>
	  </td>
    </tr>   
	<?php
		$tbanexo = new TbAnexoCheckList();
		$dados = $tbanexo->getForm($_SESSION['itemchecklist']['ich_codigo']);
		if($dados['ane_anexo']){
		?>
	<tr>
		<th>Arquivo Anexo</th>
		<td>
		<a href="BaixarArquivoAnexoCheckList.php?<?php echo(base64_encode('id').'='.base64_encode($dados['ane_codigo'])); ?>" target="_blank" ><?php echo($dados['ane_nome']);?></a>
		 <input name="ane_codigo" type="hidden"  value="<?php echo($dados['ane_codigo']); ?>" /> 
			</td>
	    </tr>
	    <?php }?>     
	<tr>
      <td align="left" nowrap="nowrap">Anexar Procedimento:</td>
	      <td>
			<input type="file" name="arquivo" value=""> 
	      </td>
    </tr>
    <tr>
      <td colspan="2" align="center">
	      <input type="submit" name="alterar"  class="button-tela" value="Alterar" />
		<script language="JavaScript"> 
					function pergunta(){ 
   						if(confirm('Tem certeza que deseja deletar este item?')){ 
      					document.itemchecklist.submit(); 
   					} 
				} 
		</script> 	      
	      <input type="button" name="apagar" onclick="pergunta()" class="button-tela" value="Apagar" />	      
	  </td>
    </tr>
  </table>
 </fieldset>
</form>
<?php unset($_SESSION['itemchecklist']);?>