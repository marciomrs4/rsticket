<?php

session_start();

include_once($_SERVER['DOCUMENT_ROOT'].'/rsticket/componentes/config.php');
include_once 'plugin/MPDF54/mpdf.php';

if($_GET)
{

$busca = new Busca();

$busca->setValueGet($_GET,'sol_codigo');
	
try
{

ob_start();

$_SESSION['buscaRapida'] = $busca->getRelatorioPDF();

?>
	<fieldset>
				<legend><img src="./css/images/header.png"><span class="titulo">RsTicket</span></legend>
				<hr/>
  <table border="2" cellspacing="5">
    <tr>
      <td colspan="0" align="center">
      	<?php Texto::mostrarMensagem($_SESSION['erro']); ?>
      </td>
    </tr>
    	<tr>
	    	<th nowrap="nowrap">
	    		N�mero do Chamado:
	    	</th>
    		<td>
	    		<?php echo($_SESSION['buscaRapida']['sol_codigo']); ?>
	    	</td>
	    </tr>
	    <tr>
	    		<th align="left">
	    			Status do Chamado:
	    		</th>
	    		<td>
	    			<?php 
	    			$tbstatuschamado = new TbStatus();
	    			echo $tbstatuschamado->getDescricao($_SESSION['buscaRapida']['sta_codigo']);
	    			?>
	    		</td>
    		</tr>
	    	<tr>
	    		<th align="left">
	    			Prioridade:
	    		</th>
	    		<td>
	    			<?php 
	    			$tbsolicitacao = new TbSolicitacao();
	    			$solicitacao = $tbsolicitacao->getPrioridadeTempoAtendimento($_SESSION['buscaRapida']['sol_codigo']);
	    			echo($solicitacao[2]);
	    			?>
	    		</td>
    		</tr>    		    		
	    	<tr>
	    		<th align="left">
	    			SLA:
	    		</th>
	    		<td>
	    			<?php 
	    			echo($solicitacao[3]);
	    			?>
	    		</td>
    		</tr>
			<tr>
	    		<th align="left">
	    			Atendente:
	    		</th>
	    		<td>
	    			<?php 
					if($_SESSION['buscaRapida']['usu_codigo'])
					{
					$tbusuario = new TbUsuario();
					$Atendente = $tbusuario->getUsuario($_SESSION['buscaRapida']['usu_codigo']);
					echo($Atendente[2]);
					}else{
						echo("Sem atendente");
					}
	    			?>
	    		</td>
    		</tr>    		    		    		
    	<tr>
	    	<th align="left">
	    		Data de Abertura:
	    	</th>
    		<td>
    		<?php 
    		$tbcalcatendimento = new TbCalculoAtendimento();
    		#Pega a data da solicita��o pelo STATUS informado, no caso 1 � ABERTURA
    		echo $tbcalcatendimento->getDataPorStatus($_SESSION['buscaRapida']['sol_codigo'],1);
			?>
    		</td>
    	</tr>    	
    <tr>
      <th width="119" align="left" nowrap="nowrap">Departamento:</th>
      <td>
      	<input type="hidden" name="sol_codigo" value="<?php echo($_SESSION['buscaRapida']['sol_codigo']); ?>">
		<?php 
		$tbdepartamento = new TbDepartamento();
		
		echo($tbdepartamento->getDepDescricao($_SESSION['buscaRapida']['dep_codigo']));
		?>
      </td>
    </tr>
    <tr>
      <th align="left" nowrap="nowrap"><?php echo($_SESSION['config']['problema']);?>:</th>
	  <td>
		<?php 
		$tbproblema = new TbProblema();
		echo($tbproblema->getProblemaDescricao($_SESSION['buscaRapida']['pro_codigo']));
		?>
	  </td>
    </tr>
    <tr>
      <th align="left" nowrap="nowrap">Descri��o do <?php echo($_SESSION['config']['problema']);?>:</th>
	      <td>
	      	<textarea name="sol_descricao_solicitacao" rows="10" cols="50"><?php echo($_SESSION['buscaRapida']['sol_descricao_solicitacao']); ?></textarea>
	      </td>
    </tr>
  </table>
       <div id="insere_aqui">
  	<?php 
  	try
  	{
	  	$tbassentamento = new TbAssentamento();
	  	$tabela = $tbassentamento->listarAssentamento($_SESSION['buscaRapida']['sol_codigo']);
	
	  	$cabecalho = array('Descri��o','Data','Editor');
	  	
	  	$grid = new DataGrid($cabecalho, $tabela);
	  	
	  	$grid->titulofield = 'Assentamento(s)';
	  	$grid->acao = 'alterar/Assentamento';
	  	$grid->islink = false;
	  	$grid->colunaoculta = 1;
	  	$grid->mostrarDatagrid();
	  	
  	}catch (Exception $e)
  	{
  		echo $e->getMessage();
  	}
  	?>     
     </div>
</fieldset>
 
<?php 

unset($_SESSION['buscaRapida']);
	
}catch (Exception $e)
{
	echo Texto::erro($e->getMessage());
}

$html = ob_get_clean();

$mpdf = new mPDF();

$mpdf->SetHeader(utf8_encode('Emitido em: - '.date("d-m-Y")));


$mpdf->SetAuthor(utf8_encode("M�rcio Ramos"));
$css =  file_get_contents('../rsticket/css/formatacao.css');

$mpdf->WriteHTML($css,1);

$mpdf->setFooter(utf8_encode('Emitido por: '.$_SESSION['usu_nome'] .' '.$_SESSION['usu_sobrenome'].' - Em: '.date("d-m-Y")));

$mpdf->WriteHTML(utf8_encode($html),2);

$mpdf->Output();

exit();

}
?>