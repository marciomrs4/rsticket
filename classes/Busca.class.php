<?php
class Busca extends Dados
{

	public function getLayoutUsuario($usu_codigo)
	{
		$tblayout = new TbLayout();
		
		try 
		{
			$usu_codigo = ($usu_codigo == '') ? 1 : $usu_codigo;
			$dados = $tblayout->selecLayoutUsuario($usu_codigo);	
			return($dados);
			
		} catch (PDOException $e)
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}		
	}
	
	public function listarChamado()
	{
		
		#Dados da busca usado para diferenciar, pois caso contrario hс um
		#conflito de nomes com abertura de chamados e listava ou DEPTO.
		$this->dados['pro_codigo_busca'];
		
		switch ($this->dados['verpor'])
		{
		
			case 0 : #Todos
				
				$this->dados['dep_codigo_solicitado'] = $_SESSION['dep_codigo'];
				$this->dados['usu_codigo_solicitante'] = $_SESSION['usu_codigo'];																
				$this->dados['sta_codigo'] = ($this->dados['sta_codigo'] == '') ? '%' : $this->dados['sta_codigo']; 
				$this->dados['pro_codigo'] = ($this->dados['pro_codigo_busca'] == '') ? '%' : $this->dados['pro_codigo_busca'];
				$this->dados['usu_nome'] = ($this->dados['usu_nome'] == '') ? '%' : $this->dados['usu_nome'];
				$this->dados['sol_descricao_solicitacao'] = ($this->dados['sol_descricao_solicitacao'] == '') ? '%' : $this->dados['sol_descricao_solicitacao'];				

				$tbsolicitacao = new TbSolicitacao();
		
				$dados = $tbsolicitacao->selectSolicitacoesDepartmentoTodos($this->dados);
		
				return($dados);
				
			break;
			
			case 1 : #Chamados que abri, ou seja fiz a solicitaчуo
				
				$tbsolicitacao = new TbSolicitacao();

				$this->dados['dep_codigo_solicitado'] = $_SESSION['dep_codigo'];												
				$this->dados['usu_codigo_solicitante'] = $_SESSION['usu_codigo'];
				$this->dados['sta_codigo'] = ($this->dados['sta_codigo'] == '') ? '%' : $this->dados['sta_codigo'];
				$this->dados['pro_codigo'] = ($this->dados['pro_codigo_busca'] == '') ? '%' : $this->dados['pro_codigo_busca'];
				$this->dados['usu_nome'] = ($this->dados['usu_nome'] == '') ? '%' : $this->dados['usu_nome'];
				$this->dados['sol_descricao_solicitacao'] = ($this->dados['sol_descricao_solicitacao'] == '') ? '%' : $this->dados['sol_descricao_solicitacao'];				

				
				$dados = $tbsolicitacao->selectMinhasSolicitacoes($this->dados);
		
				return($dados);
				
			break;
			
			case 2 : #Chamados abertos para minha equipe
				
				$this->dados['dep_codigo_solicitado'] = $_SESSION['dep_codigo'];												
				$this->dados['sta_codigo'] = ($this->dados['sta_codigo'] == '') ? '%' : $this->dados['sta_codigo']; 
				$this->dados['pro_codigo'] = ($this->dados['pro_codigo_busca'] == '') ? '%' : $this->dados['pro_codigo_busca'];
				$this->dados['usu_nome'] = ($this->dados['usu_nome'] == '') ? '%' : $this->dados['usu_nome'];
				$this->dados['sol_descricao_solicitacao'] = ($this->dados['sol_descricao_solicitacao'] == '') ? '%' : $this->dados['sol_descricao_solicitacao'];				

				$tbsolicitacao = new TbSolicitacao();
		
				$dados = $tbsolicitacao->selectSolicitacoesDepartmento($this->dados);
		
				return($dados);
				
			break;
			
			case 3 : #Chamados que estou atendendo, ou seja que foi passado pra mim
				
				$tbsolicitacao = new TbSolicitacao();
				
				$this->dados['dep_codigo_solicitado'] = $_SESSION['dep_codigo'];												
				$this->dados['usu_codigo_atendente'] = $_SESSION['usu_codigo'];
				$this->dados['sta_codigo'] = ($this->dados['sta_codigo'] == '') ? '%' : $this->dados['sta_codigo'];
				$this->dados['pro_codigo'] = ($this->dados['pro_codigo_busca'] == '') ? '%' : $this->dados['pro_codigo_busca'];
				$this->dados['usu_nome'] = ($this->dados['usu_nome'] == '') ? '%' : $this->dados['usu_nome'];
				$this->dados['sol_descricao_solicitacao'] = ($this->dados['sol_descricao_solicitacao'] == '') ? '%' : $this->dados['sol_descricao_solicitacao'];
				
				$dados = $tbsolicitacao->selectMinhasTarefas($this->dados);
		
				return($dados);
		
			break;
			
			default: 
				
			break;
			
		}
	}
	
	public function listarChamadoSolicitante()
	{
		$tbsolicitacao = new TbSolicitacao();
				
			$this->dados['dep_codigo_solicitado'] = ($this->dados['dep_codigo_busca'] == '') ? '%' : $this->dados['dep_codigo_busca'];												
			$this->dados['sta_codigo'] = ($this->dados['sta_codigo'] == '') ? '%' : $this->dados['sta_codigo'];
			$this->dados['pro_codigo'] = ($this->dados['pro_codigo_busca'] == '') ? '%' : $this->dados['pro_codigo_busca'];
			$this->dados['usu_nome'] = ($this->dados['usu_nome'] == '') ? '%' : $this->dados['usu_nome'];
			$this->dados['sol_descricao_solicitacao'] = ($this->dados['sol_descricao_solicitacao'] == '') ? '%' : $this->dados['sol_descricao_solicitacao'];
			$this->dados['dep_codigo'] = $_SESSION['dep_codigo'];
			
		$dados = $tbsolicitacao->selectSolicitacoesSolicitante($this->dados);
		
		return($dados);
	}
	

	public function listarProblema()
	{
		$this->dados['dep_codigo'] = ($this->dados['dep_codigo'] == '') ? '%' : $this->dados['dep_codigo'];
		
		$tbproblema = new TbProblema();
		
		$dados = $tbproblema->listarProblemaDepartamento($this->dados['dep_codigo']);
		
		return($dados);
		
	}
	
	public function listarChecklist()
	{

		$tbchecklist = new TbChecklist();
		
		$dados = $tbchecklist->listarChecklist();
		
		return($dados);
		
	}
	
	
}
?>