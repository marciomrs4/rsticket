<?php 
Sessao::validarForm('cadastrar/projeto'); 
?>
<table>
	<tr>
		<td>
			<fieldset>
				<legend>Cadastrar Projeto</legend>
<form name="projeto" id="projeto" method="post" action="../<?php echo($_SESSION['projeto']); ?>/action/projeto.php">
  <table border="0" cellspacing="5">
    <tr>
      <td colspan="2" align="center">
      	<?php Texto::mostrarMensagem($_SESSION['erro']); ?>
      </td>
    </tr>

    <tr>
      <th width="119" align="left" nowrap="nowrap">Código:</th>
      <th>
      	<?php $tbprojeto = new TbProjeto();
      	      echo $tbprojeto->codigoProjeto();
      	 ?>
      </th>
    </tr>
     
     <tr>
      
     	<th>
      		<input name="pro_cod_projeto" type="hidden" value="<?php echo $tbprojeto->codigoProjeto();?>" />     	 
     	</th>
     </tr>
     
     <tr>
       <th width="119" align="left" nowrap="nowrap">Previsão Inicio:</th>
     	<th> 	
      		<input type="text" id="data-id" class="data" name="pro_previsao_inicio" value="<?php echo($_SESSION['cadastrar/projeto']['pro_previsao_inicio']); ?>"  />
     	</th>
     </tr>
     
      <tr>
       <th width="119" align="left" nowrap="nowrap">Previsão Fim:</th>	
      	<th>
      		<input type="text" id="data" class="data" name="pro_previsao_fim" value="<?php echo($_SESSION['cadastrar/projeto']['pro_previsao_fim']); ?>"  />
     	</th>
     </tr>
    <tr>
      <th width="119" align="left" nowrap="nowrap">Titulo:</th>
      <td>
      	<input name="pro_titulo" type="text" size="40" maxlength="255" value="<?php echo($_SESSION['cadastrar/projeto']['pro_titulo']); ?>" />
      </td>
    </tr>



    <tr>
      <th width="119" align="left" nowrap="nowrap">Descrição:</th>
      <td>
      	<textarea name="pro_descricao" rows="5" cols="32"><?php echo($_SESSION['cadastrar/projeto']['pro_descricao']); ?></textarea>
      </td>
    </tr>
    

    <tr>
      <td colspan="2" align="left">
	      <input type="submit" name="cadastrar" id="button" value="Cadastrar" />
      </td>
    </tr>
    
  </table>
</form>

</fieldset>
</td>
</tr>
</table>
<?php unset($_SESSION['cadastrar/projeto']);?>