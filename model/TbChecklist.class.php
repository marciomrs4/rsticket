<?php

class TbChecklist extends Banco
{

	private $tabela = 'tb_checklist';

	private $che_codigo = 'che_codigo';
	private $che_titulo = 'che_titulo';
	private $che_descricao = 'che_descricao';
	private $che_data_cadastro = 'che_data_cadastro';
	private $che_email_envio = 'che_email_envio';
	private $che_ativo = 'che_ativo';
	private $dep_codigo = 'dep_codigo';
	private $usu_codigo	= 'usu_codigo';

	public function insert($dados)
	{
		$query = ("INSERT INTO $this->tabela
					($this->che_titulo, $this->che_descricao,$this->che_email_envio, 
					$this->che_ativo, $this->dep_codigo, $this->usu_codigo)
					VALUES(?,?,?,?,?,?)");

					$stmt = $this->conexao->prepare($query);

					$stmt->bindParam(1,$dados[$this->che_titulo],PDO::PARAM_STR);
					$stmt->bindParam(2,$dados[$this->che_descricao],PDO::PARAM_STR);
					$stmt->bindParam(3,$dados[$this->che_email_envio],PDO::PARAM_STR);
					$stmt->bindParam(4,$dados[$this->che_ativo],PDO::PARAM_STR);					
					$stmt->bindParam(5,$dados[$this->dep_codigo],PDO::PARAM_INT);
					$stmt->bindParam(6,$dados[$this->usu_codigo],PDO::PARAM_INT);

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

	#Usado na lista de Execu��o de checklist
	public function listarExecucaoChecklist($dep_codigo)
	{
		$query = ("SELECT CHE.che_codigo, CHE.che_titulo, CHE.che_email_envio, DEP.dep_descricao
					FROM tb_checklist AS CHE
					INNER JOIN tb_departamento AS DEP
					ON DEP.dep_codigo = CHE.dep_codigo
          			WHERE CHE.dep_codigo = ?  AND che_ativo = 1
					ORDER BY CHE.che_codigo
                
				");

		try
		{
			$stmt = $this->conexao->prepare($query);
			
			$stmt->bindParam(1,$dep_codigo,PDO::PARAM_INT);			
				
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

	public function delete($che_codigo)
	{

		$query = ("DELETE FROM $this->tabela WHERE $this->che_codigo = ? ");

		$stmt = $this->conexao->prepare($query);
			
		$stmt->bindParam(1,$che_codigo,PDO::PARAM_INT);

		$stmt->execute();

		return($stmt);
	}

	public function update($dados)
	{

		$query = ("UPDATE $this->tabela
					SET $this->che_titulo = ?, 
					$this->che_descricao = ?,
					$this->che_email_envio = ?,
					$this->che_ativo = ?,
					$this->dep_codigo = ?,
					$this->usu_codigo = ?
					WHERE $this->che_codigo = ?
					");

					$stmt = $this->conexao->prepare($query);

					$stmt->bindParam(1,$dados[$this->che_titulo],PDO::PARAM_STR);
					$stmt->bindParam(2,$dados[$this->che_descricao],PDO::PARAM_STR);
					$stmt->bindParam(3,$dados[$this->che_email_envio],PDO::PARAM_STR);
					$stmt->bindParam(4,$dados[$this->che_ativo],PDO::PARAM_STR);					
					$stmt->bindParam(5,$dados[$this->dep_codigo],PDO::PARAM_INT);
					$stmt->bindParam(6,$dados[$this->usu_codigo],PDO::PARAM_INT);
					$stmt->bindParam(7,$dados[$this->che_codigo],PDO::PARAM_INT);

					$stmt->execute();

					return($stmt);
	}

}
?>