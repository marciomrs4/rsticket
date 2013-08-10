<?php

class Arquivo extends Dados
{

	public static function includeForm()
	{

		$arquivo = $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['projeto'].'/forms/'.Validacao::descriptograr($_SESSION['acao']).'.php';

		if($_SESSION['acao'] != '')
		{
			self::validarFile($arquivo);
		}

		self::criarLinha();
	}

	private function validarFile($file)
	{
		if(file_exists($file))
		{
			include_once($file);
		}else
		{
			echo 'Formulário ou Arquivo não encontrado';
		}
	}

	private function criarLinha()
	{
		if(!empty($_SESSION['acao']))
		{
			echo('<hr />');
		}
	}

	#Retorna o Binario do arquivo temporario
	public function arquivoBinario()
	{
		set_time_limit(3600);

		$arquivo = file_get_contents($this->dados['tmp_name']);

		return($arquivo);
	}

	#Retorna o Erro do arquivo
	public function error()
	{
		return($this->dados['error']);
	}

	#Retorna o Nome do Arquivo
	public function arquivoNome()
	{
		return($this->dados['name']);
	}

	#Retorna o Tipo de arquivo
	public function arquivoTipo()
	{
		return($this->dados['type']);
	}

	#Retorna o Tamanho de arquivo
	public function arquivoTamanho()
	{
		$tamanho = round((($this->dados['size'] / 1024) /1024),2);

		return($tamanho);
	}



}

?>