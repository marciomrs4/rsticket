<?php 
Sessao::validarForm('cadastrar/Checklist'); 
?>
<table>
	<tr>
		<td>
			<fieldset>
				<legend>Cadastrar Checklist</legend>
<form name="Checklist" id="Checklist" method="post" action="../<?php echo($_SESSION['projeto']); ?>/action/Checklist.php">
  <table border="0" cellspacing="5">
    <tr>
      <td colspan="2" align="center">
      	<?php Texto::mostrarMensagem($_SESSION['erro']); ?>
      </td>
    </tr>
    
    <tr>
      <th width="119" align="left" nowrap="nowrap">Titulo:</th>
      <td>
      	<input type="text" name="che_titulo" value="<?php echo($_SESSION['cadastrar/Checklist']['che_titulo']); ?>" />
      </td>
    </tr>
 	<tr>
      <th width="119" align="left" nowrap="nowrap">E-mail de Envio:</th>
      <td>
      	<input type="text" name="che_email_envio" value="<?php echo($_SESSION['cadastrar/Checklist']['che_email_envio']); ?>" />
      </td>
    </tr>  
 	<tr>
      <th width="119" align="left" nowrap="nowrap">Descri��o:</th>
      <td>
	      	<textarea name="che_descricao" rows="10" cols="50"><?php echo($_SESSION['cadastrar/Checklist']['che_descricao']); ?></textarea>
      </td>
    </tr>        
    <tr>
      <th align="left" nowrap="nowrap">Departamento:</th>
	      <td nowrap="nowrap">
	      	<?php 
	      	$tbdepartamento = new TbDepartamento();
	      	FormComponente::selectOption('dep_codigo',$tbdepartamento->listarDepartamentos(),true,$_SESSION['cadastrar/Checklist']);
			?>
	      </td>
    </tr>
 <tr>
      <td nowrap="nowrap">Ativo:</td>
      <td>
      <?php 
      	$tbsn = new TbSimNao();
      	FormComponente::selectOption('che_ativo', $tbsn->selectSimNao(),false,$_SESSION['cadastrar/Checklist']['che_ativo']);
      ?>
	  </td>
    </tr>   
    <tr>
      <td colspan="3" align="left">
	      <input type="submit" name="cadastrar" class="button-tela" value="Cadastrar" />
      </td>
    </tr>
    
  </table>
</form>

</fieldset>
</td>
</tr>
</table>
<?php unset($_SESSION['cadastrar/Checklist']);?>