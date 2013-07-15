<?php

class TbTabela_TESTE extends Banco implements TbTabela
{
	
	private $tabela = 'tb_prioridade';
	
	public function insert($dados)
	{
		//$query = "SELECT * FROM $this->tabela";
		
		$query =  "desc tb_prioridade";
		
		$stmt = $this->conexao->prepare($query);
		
		$stmt->execute();
		
		return($stmt);
		
	}

	public function select($colum, $param = null)
	{
		
	}

	public function getForm($codigo_id_tabela){}
	
	public function update($dados){}
	
}
?>