<?php 
Sessao::validarForm('cadastrar/departamento'); 
?>
<table>
	<tr>
		<td>
			<fieldset>
				<legend>Novo Departamento</legend>
<form name="arquivo" method="post" action="../<?php echo($_SESSION['projeto']); ?>/action/departamento.php">
  <table border="0" cellspacing="5">
    <tr>
      <td colspan="2" align="center">
      	<?php Texto::mostrarMensagem($_SESSION['erro']); ?>
      </td>
    </tr>
    
    <tr>
      <th width="119" align="left" nowrap="nowrap">Departamento:</th>
      <td>
      	<input name="dep_descricao" type="text" value="<?php echo($_SESSION['cadastrar/departamento']['dep_descricao']); ?>" />
      </td>
    </tr>
    <tr>
      <th align="left" nowrap="nowrap">Permite Listar no Chamado:</th>
	      <td>
	      	<?php 
			$tbSN = new TbSimNao();
	      	FormComponente::selectOption('pro_permite_listar_chamado',$tbSN->selectSimNao(),false,$_SESSION['cadastrar/departamento']);	      	
	      	?>
	      </td>
    </tr>
    
    <tr>
      <th align="left" nowrap="nowrap">E-mail:</th>
	      <td>
	      	<input name="dep_email" type="text" value="<?php echo($_SESSION['cadastrar/departamento']['dep_email']); ?>"/>
	      </td>
    </tr>

    <tr>
      <td colspan="2" align="right">
	      <input type="submit" name="cadastrar" id="button" value="Cadastrar" />
      </td>
    </tr>
    
  </table>
</form>

</fieldset>
</td>
</tr>
</table>
<?php unset($_SESSION['cadastrar/departamento']);?>