<form name="cadastrar/ItemChecklist" enctype="multipart/form-data" method="post" action="../rsticket/action/itemchecklist.php">
 
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
      <input name="ich_titulo_tarefa" type="text" size="40" value="<?php echo $_SESSION['cadastrar/ItemChecklist']['ich_titulo_tarefa']?>" />
      </td>
    </tr>
    <tr>
      <td nowrap="nowrap">Link:</td>
      <td>
      <input name="ich_link" type="text" size="40" value="<?php echo $_SESSION['cadastrar/ItemChecklist']['ich_link']?>" />
      <input name="che_codigo" type="hidden"  value="<?php echo $_SESSION['cadastrar/ItemChecklist']['che_codigo']?>" />      
      </td>
    </tr>
    <tr>
      <td nowrap="nowrap">Ativo:</td>
      <td>
      <?php 
      	$tbsn = new TbSimNao();
      	FormComponente::selectOption('ich_ativo', $tbsn->selectSimNao(),false,$_SESSION['cadastrar/ItemChecklist']['ich_ativo']);
      ?>
	  </td>
    </tr>
	<tr>
      <td align="left" nowrap="nowrap">Anexar Procedimento:</td>
	      <td>
			<input type="file" name="arquivo" value=""> 
	      </td>
    </tr>        
    
    <tr>
      <td colspan="2" align="center">
	      <input type="submit" name="alterar" class="button-tela" value=" Cadastrar " />
	  </td>
    </tr>
  </table>
 </fieldset>
</form>
<?php unset($_SESSION['cadastrar/ItemChecklist']);?>