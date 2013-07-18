<?php

class ControleDeAcesso extends Sessao
{

	static $root = 1;
	
	static $Solicitante = 2;
	static $Tecnico = 3;
	static $TecnicoADM = 4;
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
		#Verifica se o TAC_CODIGO esta dentro do arrau NIVEL
		#Ou se caso seja ROOT
		if(in_array($_SESSION['tac_codigo'],$nivel) or $_SESSION['tac_codigo'] == self::$root )
		{}
		else
		{
			self::redirect();
		}
	}

	private function redirect()
	{
		$_SESSION['erro'] = '� necess�rio fazer login para esse acesso.';
		$_SESSION['sempermissao'] = 'Voc� n�o tem permiss�o para acessar esta op��o.';
		header("location: ../{$_SESSION['projeto']}/index.php");
	}

	public static function permitirBotao($botao,$nivel)
	{
		#Verifica se o TAC_CODIGO esta dentro do arrau NIVEL
		if(in_array($_SESSION['tac_codigo'],$nivel) or $_SESSION['tac_codigo'] == self::$root)
		{
			echo($botao);
		}
	}

}
?>