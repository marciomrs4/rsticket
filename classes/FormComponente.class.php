<?php

class FormComponente
{

	static $name = "Selecione...";
	
	/**
	 * 
	 * Enter description here ...
	 * @param String $campoform
	 * @param String $campo
	 * 
	 * @author Márcio Ramos
	 * @tutorial Este metodo é usado para comparar dois campos
	 * e caso sejam iguais ele retorna o campo selecionado
	 */
	public static function selectedItem($campoform,$campo)
	{
		if($campoform == $campo)
		{
			return('selected="selected"');
		} 
	}

	/**
	 * 
	 * @param String $selectname
	 * @param Object $objpdo
	 * @param bolean $valor
	 * @param String $campo
	 * 
	 * @author Márcio Ramos
	 * @tutorial Este metodo recebe dois parametros obrigatorios
	 * selectname e objpdo, os outros valor e campo não são obrigatorios
	 * ele já cria o campo select completo e ja lista o q estiver no objpdo
	 */
	public static function selectOption($selectname,$objpdo,$valor=true,$campo=null)
	{
		echo("<select name='" . $selectname . "'>");
          echo(self::optionVazio($valor));
			foreach ($objpdo as $linha):
				echo("<option value='");
					echo($linha[0]. "'");
						echo(self::selectedItem($campo[$selectname],$linha[0]));
							echo('>');
					echo($linha[1]);
				echo('</option>');
			endforeach;
		echo('</select>');
	}
	
	private static function optionVazio($valor)
	{
		if($valor)
		{
			return('<option value="">'.self::$name.'</option>');
		}
	}

	public static function validarForm($returnbanco,$valor,$returntrue, $returnfalse)
	{
		 echo ($returnbanco == $valor) ? $returntrue : $returnfalse;
	}
	
	public static function actionButton($nameButton,$acao)
	{
		
		return('<a href=/'.$_SESSION['projeto'].'/action/formcontroler.php?'.base64_encode($acao).'>'.$nameButton.'</a>');
	}
	
	public static function validarComponente($valorvalidar,$returntrue,$returnfalse)
	{
		if(!empty($valorvalidar))
		{
			echo($returntrue);
		}else
		{
			echo($returnfalse);
		}
	}
	
}