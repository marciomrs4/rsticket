<?php

class ControleDeAcesso extends Sessao
{

	static $root = 1;
	
	static $Solicitante = 2;
	static $Receptor = 3;
	static $Executor = 4;
	static $Aprovador = 5;
	
	public static function acessoComun()
	{
		//session_start();
		
		if(isset($_SESSION['ace_usuario'],$_SESSION['ace_codigo']))
		{}
		else
		{
			self::redirect();
		}
	}

	public static function permitirAcesso($nivel)
	{
		//session_start();

		if(isset($_SESSION['ace_codigo'],$_SESSION['usu_codigo']))
		{
			self::acessar($nivel);
		}
		else
		{
			self::redirect();
		}
	}

	protected static function acessar($nivel)
	{
		if($_SESSION['tac_codigo'] == $nivel or $_SESSION['tac_codigo'] == self::$root )
		{}
		else
		{
			self::redirect();
		}
	}

	private function redirect()
	{
		$_SESSION['erro'] = 'Щ necessсrio fazer login para esse acesso.';
		$_SESSION['sempermissao'] = 'Vocъ nуo tem permissуo para acessar esta opчуo.';
		header("location: ../{$_SESSION['projeto']}/index.php");
	}

	public static function permitirBotao($botao,$nivel)
	{
		if($_SESSION['tac_codigo'] == $nivel or $_SESSION['tac_codigo'] == self::$root)
		{
			echo($botao);
		}
	}

}
?>