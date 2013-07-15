<?php 
Sessao::validarForm('alterar/projeto'); 

$tbprojeto = new TbProjeto();
$_SESSION['alterar/projeto'] = $tbprojeto->getFormAlteracao(base64_decode($_SESSION['valorform']));

?>
<table>
	<tr>
		<td>
			<fieldset>
				<legend>Alterar Projeto</legend>
<form name="arquivo" method="post" action="../<?php echo($_SESSION['projeto']); ?>/action/projeto.php">
  <table border="0" cellspacing="5">
    <tr>
      <td colspan="2" align="center">
      	<?php Texto::mostrarMensagem($_SESSION['erro']); ?>
      </td>
    </tr>

    <tr>
      <th width="119" align="left" nowrap="nowrap">Código:</th>
      <th>
      	<?php 
			echo $_SESSION['alterar/projeto']['pro_cod_projeto'];
      	 ?>
      </th>
    </tr>
     
     <tr>
     	<th>
      		<input name="pro_codigo" type="hidden" value="<?php echo($_SESSION['alterar/projeto']['pro_codigo']);?>" />     	 
     	</th>
     </tr>
     
     <tr>
       <th width="119" align="left" nowrap="nowrap">Previsão Inicio:</th>
     	<th> 	
      		<input type="text" id="data-id" class="data" name="pro_previsao_inicio" value="<?php echo(ValidarDatas::dataCliente($_SESSION['alterar/projeto']['pro_previsao_inicio'])); ?>"  />
     	</th>
     </tr>
     
      <tr>
       <th width="119" align="left" nowrap="nowrap">Previsão Fim:</th>	
      	<th>
      		<input type="text" id="data" class="data" name="pro_previsao_fim" value="<?php echo(ValidarDatas::dataCliente($_SESSION['alterar/projeto']['pro_previsao_fim'])); ?>"  />
     	</th>
     </tr>
    <tr>
      <th width="119" align="left" nowrap="nowrap">Titulo:</th>
      <td>
      	<input name="pro_titulo" type="text" size="40" maxlength="255" value="<?php echo($_SESSION['alterar/projeto']['pro_titulo']); ?>" />
      </td>
    </tr>

    <tr>
      <th width="119" align="left" nowrap="nowrap">Descrição:</th>
      <td>
      	<textarea name="pro_descricao" rows="5" cols="32"><?php echo($_SESSION['alterar/projeto']['pro_descricao']); ?></textarea>
      </td>
    </tr>
    <tr>
      <th width="119" align="left" nowrap="nowrap">Status:</th>
      <td>
		<?php 
		$tbstatusprojeto = new TbStatusProjeto();
		FormComponente::selectOption('stp_codigo', $tbstatusprojeto->selectStatus(),false,$_SESSION['alterar/projeto']);
		?>
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
<?php unset($_SESSION['alterar/projeto']);?>