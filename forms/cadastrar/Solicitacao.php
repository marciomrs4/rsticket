<?php 
Sessao::validarForm('cadastrar/Solicitacao'); 
?>

<form name="solicitacao" id="solicitacao" method="post" enctype="multipart/form-data" action="../<?php echo($_SESSION['projeto']); ?>/action/solicitacao.php">
<fieldset>
	<legend> Abrir Chamado </legend>
  <table border="0" cellspacing="5">
    <tr>
      <td colspan="2" align="center">
      	<?php Texto::mostrarMensagem($_SESSION['erro']); ?>
      </td>
    </tr>
    
    <tr>
      <th width="119" align="left" nowrap="nowrap">Departamento:</th>
      <td>
		<?php 
		$tbdepartamento = new TbDepartamento();
		FormComponente::$name = 'Selecione';
		FormComponente::selectOption('dep_codigo',$tbdepartamento->listarDepartamentos(),true,$_SESSION['cadastrar/Solicitacao']);
		?>
      </td>
    </tr>
    <tr>
      <th align="left" nowrap="nowrap"><?php echo($_SESSION['config']['problema']); ?>:</th>
	      <td>
  		   <?php 
		       $tbproblema = new TbProblema();
		       FormComponente::$name = 'Selecione';
		       FormComponente::selectOption('pro_codigo',$tbproblema->listarProblema($_SESSION['dep_codigo']),true,$_SESSION['cadastrar/Solicitacao']);
		   ?>
</td>
    </tr>
    <tr>
      <th align="left" nowrap="nowrap">Descri��o do <?php echo($_SESSION['config']['problema']); ?>:</th>
	      <td>
	      	<textarea name="sol_descricao_solicitacao" rows="10" cols="50"><?php echo($_SESSION['cadastrar/Solicitacao']['sol_descricao_solicitacao']); ?></textarea>
	      </td>
    </tr>
    
    <tr>
    	<th>Anexo:</th>
    	<td>
    		<input type="file" name="arquivo" />
    	</td>
    </tr>
    <tr>
      <td colspan="2" align="left">
	      <input type="submit" name="cadastrar" class="button-tela" value="Salvar" />
      </td>
    </tr>

  </table>
       <div id="insere_aqui">
     </div>
</fieldset>
</form>

<?php unset($_SESSION['cadastrar/Solicitacao']);?>