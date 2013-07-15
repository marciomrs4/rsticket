<?php

session_start();

include_once($_SERVER['DOCUMENT_ROOT'].'/rsticket/componentes/config.php');
include_once 'plugin/MPDF54/mpdf.php';



if($_GET)
{
$solicitacao = new TbSolicitacao();

$busca = new Busca();

$busca->setValueGet($_GET,'sol_codigo');

$tabela = $solicitacao->getFormAssentamento($busca->getValueGet('sol_codigo'));
	
}

ob_start();
?>
<p>Relatório de cliente</p><hr>
<fieldset>
    <legend>Dados do Cliente</legend>
    <table border="0">
 	  <tr>
        <td><?php echo("Minha tarefa"); ?></td>
      </tr>
     </table>
</fieldset>
  			<hr>
  <fieldset>
    <legend>Contato    </legend>
    <table width="200" border="0">
      <tr>
        <td nowrap="nowrap">Telefone</td>
        <td><input type="text" name="con_tel" class="tel" /></td>
      </tr>
      <tr>
        <td><label for="con_cel">Celular</label></td>
        <td><input type="text" name="con_cel" class="cel" /></td>
      </tr>
      <tr>
        <td>E-mail</td>
        <td><input type="text" name="con_email" id="con_email" /></td>
      </tr>
      <tr>
        <td>Site</td>
        <td><input type="text" name="con_site" id="con_site" /></td>
      </tr>
      <tr>
        <td>Contato</td>
        <td><input type="text" name="con_contato" id="con_contato" /></td>
      </tr>
    </table>
  </fieldset>
  <fieldset>
    <legend>Endereço</legend>
    <table width="200" border="0">
      <tr>
        <td nowrap="nowrap"><label for="end_logradouro">Logradouro</label></td>
        <td><input name="end_logradouro" type="text" id="end_logradouro" size="70" /></td>
      </tr>
      <tr>
        <td>Bairro</td>
        <td><input type="text" name="end_bairro" id="end_bairro" /></td>
      </tr>
      <tr>
        <td><label for="end_cidade">Cidade</label></td>
        <td><input type="text" name="end_cidade" id="end_cidade" /></td>
      </tr>
      <tr>
        <td><label for="end_cep">Cep</label></td>
        <td><input type="text" name="end_cep" class="cep" /></td>
      </tr>
      <tr>
        <td nowrap="nowrap"><label for="end_complemento">Complemento</label></td>
        <td><input type="text" name="end_complemento" id="end_complemento" /></td>
      </tr>
      <tr>
        <td nowrap="nowrap"><label for="end_estado">Estado</label></td>
        <td><select name="estado" id="select">
          <?php #$tbestado->selectAllEstado(); ?>
        </select></td>
      </tr>
      <tr>
        <td>Tipo</td>
        <td><select name="end_tipo" id="select3">
          <option>Matriz</option>
          <option>Filial</option>
        </select></td>
      </tr>
    </table>
</fieldset>    
<?php

$html = ob_get_clean();

$mpdf = new mPDF();

$mpdf->SetHeader(utf8_encode('Emitido em: - '.date("d-m-Y")));


$mpdf->SetAuthor(utf8_encode("Márcio Ramos"));
$css =  file_get_contents('../rsticket/css/formatacao.css');

$mpdf->WriteHTML($css,1);

$mpdf->setFooter(utf8_encode('Emitido por: '.$_SESSION['usu_nome_completo'].' - '.date("d-m-Y").' às '.date("H:i:s")));

$mpdf->WriteHTML(utf8_encode($html),2);

$mpdf->Output();

exit();

?>