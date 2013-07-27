<?php
class Email
{

	public $mensagem;
	public $cabecalho;
	public $para; // = 'marcio.santos@ceadis.org.br';
	public $emaildominio = 'suporte.infra@ceadis.org.br';
	//public $emaildominio = 'sistema@rstecnologia.net';
	
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
		$headers .= "From: $this->emaildominio\r\n"; // remetente
		$headers .= "Return-Path: $this->emaildominio\r\n";

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

	public function aberturaChamado($dados)
	{
		$tbusuario = new TbUsuario();
		
		$email = $tbusuario->getUsuario($dados['usu_codigo_solicitante']);
		
		$this->para = $email['usu_email'];
		
		$this->cabecalho = 'Abertura de Chamado';
		
		$this->mensagem = "O Chamado de número: ".$dados['sol_codigo']."\r\n";
		$this->mensagem .= "Foi aberto com sucesso, logo um técnico irá atende-lo";
		
		$this->enviarEmail();
		
	}
	
	
}
