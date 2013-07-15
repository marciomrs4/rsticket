<?php
/**
 * @author Márcio Ramos e-mail: marciomrs4@hotmail.com
 * @name Titulo
 * @example Essa classe é utilizada para criar titulo já formatado
 * @package script
 * @version 1.0 Data 20/04/2011
 * 
 */
final class Texto
{	

	
	/**
	 * @author Márcio Ramos e-mail: marciomrs4@hotmail.com
	 * @name criaTitulo
	 * @package script
	 * @param titulo
	 */
	
	
	public static function criarTitulo($titulo)
	{	
		echo("<p class='titulo'> {$titulo} </p>");		
	}
	
	public static function criarSubTitulo($string)
	{
		echo("<p class='subtitulo'> {$string} </p><hr>");
	}

	public static function mostrarMensagem($msg)
	{
		if(!isset($msg))
		{
			$msg = null;
		}	
		echo($msg);
	}
		
	public static function erro($msg)
	{
		return("<p class='erro'> {$msg} </p>");
	}
	
	public static function sucesso($msg)
	{
		return("<p class='sucesso'> {$msg} </p>");
	}
	
	public static function InverterString($string)
	{
		return strrev($string);
	}
	
}

?>