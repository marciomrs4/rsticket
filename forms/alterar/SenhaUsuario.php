<?php 
$tbacesso = new TbAcesso();

$_SESSION['alterar/SenhaUsuario'] = $tbacesso->getForm(base64_decode($_SESSION['valorform']));


?>
<table>
	<tr>
		<td>
			<fieldset>
				<legend>Alterar Senha do Usu�rio</legend>
<form name="arquivo" method="post" action="../<?php echo($_SESSION['projeto']); ?>/action/usuario.php">
  <table border="0" cellspacing="5">
    <tr>
      <td colspan="2" align="center">
      	<?php Texto::mostrarMensagem($_SESSION['erro']); ?>
      </td>
    </tr>

   	<tr>
      <th align="left" nowrap="nowrap">Usu�rio:</th>
	      <td>
	      	<input name="ace_codigo" type="hidden" value="<?php echo($_SESSION['alterar/SenhaUsuario']['ace_codigo']); ?>"/>	      
	      	<input name="ace_usuario" type="text" value="<?php echo($_SESSION['alterar/SenhaUsuario']['ace_usuario']); ?>"/>
	      </td>
    </tr>
    
   	<tr>
      <th align="left" nowrap="nowrap">Senha:</th>
	      <td>
	      	<input name="ace_senha" type="password" value=""/>
	      </td>
    </tr>    
    
   	<tr>
      <th align="left" nowrap="nowrap">Repetir Senha:</th>
	      <td>
	      	<input name="ace_senha2" type="password" value=""/>
	      </td>
    </tr>    
    
    <tr>
      <td colspan="2" align="right">
	      <input type="submit" name="cadastrar" id="button" value="Alterar" />
      </td>
    </tr>
    
  </table>
</form>

</fieldset>
</td>
</tr>
</table>
<?php unset($_SESSION['alterar/SenhaUsuario']);?>