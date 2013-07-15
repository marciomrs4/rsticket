<?php

class TbItemChecklist extends Banco
{
	
	private $tabela = 'tb_item_checklist';

	private $ich_codigo = 'ich_codigo';
	private $ich_titulo_tarefa = 'ich_titulo_tarefa';
	private $ich_ativo = 'ich_ativo';
	private $ich_link = 'ich_link';
	private $che_codigo = 'che_codigo';
	
	public function insert($dados)
	{	
		$query = ("INSERT INTO $this->tabela
					($this->ich_titulo_tarefa, $this->ich_ativo,
					$this->ich_link, $this->che_codigo)
					VALUES(?,?,?,?)");
		
		$stmt = $this->conexao->prepare($query);
		
		$stmt->bindParam(1,$dados[$this->ich_titulo_tarefa],PDO::PARAM_STR);
		$stmt->bindParam(2,$dados[$this->ich_ativo],PDO::PARAM_STR);
		$stmt->bindParam(3,$dados[$this->ich_link],PDO::PARAM_STR);
		$stmt->bindParam(4,$dados[$this->che_codigo],PDO::PARAM_INT);
		
		$stmt->execute();
		
		return($stmt);
		
	}

	public function select($colum, $param = null)
	{
		
	}
	
	public function listarChecklist()
	{
		$query = ("SELECT CHE.che_codigo, CHE.che_titulo, CHE.che_email_envio, DEP.dep_descricao
					FROM tb_checklist AS CHE
					INNER JOIN tb_departamento AS DEP
					ON DEP.dep_codigo = CHE.dep_codigo
					ORDER BY CHE.che_codigo
				");
		
		try
		{
			$stmt = $this->conexao->prepare($query);
			
			$stmt->execute();
			
			return($stmt);
			
		}catch (PDOException $e)
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}
		
		
	}

	public function getForm($che_codigo)
	{
		$query = ("SELECT * FROM $this->tabela
					WHERE $this->che_codigo = ?");
		
		try 
		{
			$stmt = $this->conexao->prepare($query);
			
			$stmt->bindParam(1,$che_codigo,PDO::PARAM_INT);
			
			$stmt->execute();
			
			$dados = $stmt->fetch();
			
			return($dados);
			
		} catch (PDOException $e) 
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}
		
	}
	
	public function update($dados)
	{
	
		$query = ("UPDATE $this->tabela
					SET $this->che_titulo = ?, 
						$this->che_descricao = ?,
						$this->che_email_envio = ?, 
						$this->dep_codigo = ?, 
						$this->usu_codigo = ?
					WHERE $this->che_codigo = ?
					");
		
		$stmt = $this->conexao->prepare($query);
		
		$stmt->bindParam(1,$dados[$this->che_titulo],PDO::PARAM_STR);
		$stmt->bindParam(2,$dados[$this->che_descricao],PDO::PARAM_STR);
		$stmt->bindParam(3,$dados[$this->che_email_envio],PDO::PARAM_STR);
		$stmt->bindParam(4,$dados[$this->dep_codigo],PDO::PARAM_INT);
		$stmt->bindParam(5,$dados[$this->usu_codigo],PDO::PARAM_INT);										
		$stmt->bindParam(6,$dados[$this->che_codigo],PDO::PARAM_INT);										
				
		$stmt->execute();
		
		return($stmt);	
	}
	
}
?>