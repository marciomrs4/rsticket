<?php

class DataGrid
{

	/**
	 * Descri��o ...
	 * @var string
	 * @example Inserir o nome da classe CSS para linha
	 * csslinha1 = 'cssnome'
	 */
	public $csslinha1 = 'linha1';

	/**
	 * Descri��o ...
	 * @var string
	 * @example Inserir o nome da classe CSS para linha
	 * csslinha2 = 'cssnome'
	 */
	public $csslinha2 = 'linha2';

	/**
	 * Descri��o ...
	 * @var string
	 * @example Inserir o nome da classe CSS para cabe�alho
	 * csscabecalho = 'cssnome'
	 */
	public $csscabecalho = 'linha3';

	/**
	 * Descri��o ...
	 * @var int
	 * @example Inserir o valor para borda
	 * borda = 1
	 */
	public $borda = 0;

	/**
	 * Descri��o ...
	 * @var string
	 * @example Inserir o nome da classe CSS para tabela
	 * csstabela = 'cssnome'
	 */
	public $csstabela = 'tabela';

	/**
	 * Descri��o ...
	 * @var string
	 * @example Inserir o nome da variav�l que vai no link
	 * getnome = 'pes_codigo'
	 */
	public $acao;
	
	public $acao2;

	/**
	 * Descri��o ...
	 * @var string
	 * @example Inserir o nome do link que aparecer� para clicar
	 * nomelink = 'Clique Aqui'
	 */
		
	public $nomelink = "<img src='/rsticket/css/images/editar.gif' />";

	public $nomelink2 = '<img src="/rsticket/css/images/adcionar.png" />';
	
	
	
	/**
	 * Descri��o ...
	 * @var string
	 * @example Inserir o nome do link que sej� chamado ao clicar
	 * link = 'link.php'
	 */
	public $link = '/rsticket/action/formcontroler.php';
	public $link2 = '/rsticket/action/formcontroler.php';

	/**
	 * Descri��o ...
	 * @var bolean
	 * @example Inserir valor boleano para poder aparecer o link
	 * com javascript
	 * islinkJavasript = true
	 */
	public $colunaoculta = 0;

	/**
	 * Descri��o ...
	 * @var bolean
	 * @example Inserir valor boleano para poder aparecer o link
	 * islink = true
	 */
	public $islink = true;
	
	public $islink2 = false;
	
	/**
	 * Descri��o ...
	 * @var array
	 * @example dados que devem ser mostrados na tabela
	 * dados = tabeladedados
	 */
	private $dados;

	/**
	 * Descri��o ...
	 * @var array
	 * @example Nomes para o titulo de cada coluna
	 * cabecalho = titulodascolunas
	 */
	
	public $titulofield;
		
	private $cabecalho;

	/**
	 * Descri��o ...
	 * @var int
	 * @example quantidade de colunas que haver� na tabela, obtido automaticamente
	 * coluna = quantidadecoluna
	 */
	private $coluna;

	/**
	 *
	 * Enter description here ...
	 * @param array $cabecalho
	 * @param array $dados
	 * @author
	 */
	public function __construct($cabecalho,$dados)
	{
		$this->dados = $dados;
		$this->cabecalho = $cabecalho;
	}

	/**
	 *
	 * Enter description here ...
	 * @example Metodo que cria o cabe�alho baseado no array informado no
	 * construtor
	 */
	
	private function criaCabecalho()
	{
		echo("<div id='tabela'><br /><br />
				<fieldset>
					<legend>{$this->titulofield} Encontrado(s): {$this->dados->rowcount()} resultado(s)</legend>
				<table class='{$this->csstabela}' border='{$this->borda}'>
			<thead>
			<tr align='center' class='{$this->csscabecalho}'>");
		foreach ($this->cabecalho as $cabecalho):
		echo("<th nowrap='nowrap'><a href='#' class='{$this->csstabela}'>{$cabecalho}</a></th>");
		endforeach;
		echo("</tr>
			</thead>");
	}

	/**
	 *
	 * Enter description here ...
	 * @example Metodo que cria a tabela com os dados iformados no contrutor
	 */
	private function criaTabela()
	{
		$linha = 0;
		foreach ($this->dados as $campo)
		{
			$estilo = ValidarCampos::campoTernario($linha,$this->csslinha1,$this->csslinha2);
			$this->coluna = count($campo) / 2;
			echo("<tr class ='{$estilo}'>");
			for($x = $this->colunaoculta; $x < $this->coluna ; $x++)
			{
				echo("<td>{$campo[$x]}</td>");
			}
			$linha++;
			self::colunaLink(base64_encode($campo[0]));
			self::colunaLink2(base64_encode($campo[0]));			
		}
		echo('</tr>');
	}

	/**
	 *
	 * Enter description here ...
	 * @param int $campo
	 * @example Criar as colunas de link com o ID que deve ser a primeira posicao
	 * do array informado no array dados no construtor
	 */
	private function colunaLink($campo)
	{
		if($this->islink)
		{
			echo("<td class='{$this->csstabela}'><a href='{$this->link}?{$this->getAcao()}={$campo}' 
					  class='{$this->csstabela}'>{$this->nomelink}</a></td>");
		}
	}
	
	private function getAcao()
	{
		return(base64_encode($this->acao));
	}
	
	
	private function colunaLink2($campo)
	{
		if($this->islink2)
		{
			echo("<td class='{$this->csstabela}'><a href='{$this->link2}?{$this->getAcao2()}={$campo}' 
					  class='{$this->csstabela}'>{$this->nomelink2}</a></td>");
		}
	}
	
	private function getAcao2()
	{
		return(base64_encode($this->acao2));
	}
	
	
	/**
	 *
	 * Enter description here ...
	 * @example Metodo que cria o rodap� com a quantidade de linhas retornadas
	 * da busca
	 */
	private function criaRodape()
	{
		echo("<tfoot>
			<tr align='center'>
				<td colspan='{$this->coluna}' class='{$this->csscabecalho}'>Resultado(s) encontrado(s) {$this->dados->rowCount()}</td>
			 </tr>
			</tfoot>
		</table>
		</fieldset>
			</div>");
	}

	/**
	 * @example Metodo que mostra a tabela na tela, chamando todos
	 * os metodos anteriores
	 */
	public function mostrarDatagrid()
	{
		self::criaCabecalho();
		self::criaTabela();
		self::criaRodape();
	}
}
?>