<?php
class Email
{

	public $mensagem;
	public $cabecalho;
	public $para; // = 'marcio.santos@ceadis.org.br';
	//public $emaildominio = 'suporte.infra@ceadis.org.br';
	public $emaildominio = 'sistema@rstecnologia.net';

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

		$tbdepartamento = new TbDepartamento();
		$emaildepto = $tbdepartamento->getDepartamentoEmail($dados['dep_codigo_solicitado']);

		$tbprobleama = new TbProblema();
		$problema = $tbprobleama->getForm($dados['pro_codigo']);

		$this->para = $email['usu_email'].','.$emaildepto;

		$this->cabecalho = 'Abertura de Chamado: '.$dados['sol_codigo'];

		$this->mensagem = 'O Chamado de número: '.$dados['sol_codigo'].'<br/>';
		$this->mensagem .= 'Foi aberto com sucesso por: '.$email['usu_email'].' e logo um técnico irá atende-lo <br/>';
		$this->mensagem .= 'Contato:  '.$email['usu_nome'].' - Tel / '.$_SESSION['config']['ramal'].': '.$email['usu_ramal'].'<br/>';
		$this->mensagem .= $_SESSION['config']['problema'].': '.$problema['pro_descricao'].'<br/>';
		$this->mensagem .= 'Descrição do '.$_SESSION['config']['problema'].': '.$dados['sol_descricao_solicitacao'].'<br/>';

		$this->enviarEmail();

	}

	public function interacaoAssentamento($dados)
	{

		#Pego informacoes da solicitacao, Codigo do problema
		$tbsolcitacao = new TbSolicitacao();
		#Pego o codigo do problema
		$pro_codigo = $tbsolcitacao->getProblema($dados['sol_codigo']);
		#Pego o codigo do DEPTO solicitado
		$dep_codigo_solicitado = $tbsolcitacao->getCodigoDepartamentoSolicitado($dados['sol_codigo']);

		#Pego informações do usuarios
		$tbusuario = new TbUsuario();
		$email = $tbusuario->getUsuario($tbsolcitacao->getUsuarioSolicitante($dados['sol_codigo']));
		
		$emailUsuarioCriador = $tbusuario->getUsuario($dados['usu_codigo']);
		
		
		$tbdepartamento = new TbDepartamento();
		$emaildepto = $tbdepartamento->getDepartamentoEmail($dep_codigo_solicitado);

		#Pego a descrição do problema 
		$tbprobleama = new TbProblema();
		$problema = $tbprobleama->getForm($pro_codigo);
		
		$tbstatus = new TbStatus();
		$sta_descricao = $tbstatus->getDescricao($tbsolcitacao->getStatus($dados['sol_codigo']));
		
		$this->para = $email['usu_email'].','.$emaildepto;

		$this->cabecalho = 'Assentamento do chamado:'.$dados['sol_codigo'];

		$this->mensagem = 'Houve uma iteração no chamado: '.$dados['sol_codigo'].'<br/>';
		$this->mensagem .= 'Assentamento criado por: '.$emailUsuarioCriador['usu_email'].'<br/>';
		$this->mensagem .= $_SESSION['config']['problema'].': '.$problema['pro_descricao'].'<br/>';		
		$this->mensagem .= 'Foi adcionado o seguinte assentamento: '.$dados['ass_descricao'].'<br/>';
		$this->mensagem .= 'Status do chamado: '.$sta_descricao;
		
		$this->enviarEmail();

	}
	

}
