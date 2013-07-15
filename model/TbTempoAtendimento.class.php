<?php

class TbTempoAtendimento extends Banco
{

	private $tabela = 'tb_tempo_atendimento';
	
	private $tat_codigo = 'tat_codigo';
	private $tat_descricao = 'tat_descricao';
	private $dep_codigo = 'dep_codigo';
	
	public function insert($dados)
	{
		
		$query = ("INSERT INTO $this->tabela ($this->tat_descricao,$this->dep_codigo)
					VALUES(?,?)");

		try{
			$stmt = $this->conexao->prepare($query);

			$stmt->bindParam(1,$dados[$this->tat_descricao],PDO::PARAM_STR);
			$stmt->bindParam(2,$dados[$this->dep_codigo],PDO::PARAM_INT);			

			$stmt->execute();

			return($this->conexao->lastInsertId());

		}
		catch (PDOException $e)
		{
			throw new PDOException("Erro na tabela". get_class($this)."-". $e->getMessage(),$e->getCode());
		}

	}

	public function update($dados)
	{
		$query = ("UPDATE $this->tabela
					SET	$this->tat_descricao = ?
					WHERE $this->tat_codigo = ? ");
		try
		{
			$stmt = $this->conexao->prepare($query);

			$stmt->bindParam(1,$dados[$this->tat_descricao],PDO::PARAM_STR);
			$stmt->bindParam(2,$dados[$this->tat_codigo],PDO::PARAM_STR);			
			
			$stmt->execute();

			return($stmt);

		} catch (PDOException $e)
		{
			throw new PDOException($e->getMessage(),$e->getCode());
		}

	}

	public function selectMeuTempoAtendimento($dep_codigo)
	{
		$query = ("SELECT $this->tat_codigo, $this->tat_descricao
					FROM $this->tabela
					WHERE $this->dep_codigo = ?
					ORDER BY $this->tat_codigo");

		try
		{
			$stmt = $this->conexao->prepare($query);

			$stmt->bindParam(1, $dep_codigo,PDO::PARAM_INT);
			
			$stmt->execute();

			return($stmt);

		} catch (PDOException $e)
		{
			throw new PDOException($e->getMessage(),$e->getMessage());
		}
	}
	
	public function getForm($tat_codigo)
	{

		$query = ("SELECT $this->tat_codigo, $this->tat_descricao 
					FROM  $this->tabela 
				   	WHERE $this->tat_codigo = ?
				   ");

		try
		{
			$stmt = $this->conexao->prepare($query);

			$stmt->bindParam(1,$tat_codigo,PDO::PARAM_INT);

			$stmt->execute();

			return($stmt->fetch());

		} catch (PDOException $e)
		{
			throw new PDOException($e->getMessage(),$e->getCode());
		}

	}

}
?>