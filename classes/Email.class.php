<?php
class Email
{

	public $mensagem;
	public $cabecalho;
	//public $para = 'tecnologia@ceadis.org.br';
	public $para = 'marcio.santos@ceadis.org.br';
	
	public $erro;

	public function enviarEmail()
	{
		date_default_timezone_set('America/Sao_Paulo');	
		$this->erro = mail($this->para,$this->cabecalho,$this->mensagem,self::header());
	}

	private function header()
	{
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		return($headers);
	}

	public function setPara($para)
	{
		$this->para = $para;
	}

	public function setMensagem($mensagem)
	{
		$this->mensagem = $mensagem;
	}

	public function setCabecalho($cabecalho)
	{
		$this->cabecalho = $cabecalho;
	}

}
