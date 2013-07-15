<?php

class TbAtendenteSolicitacao extends Banco
{

	private $tabela = 'tb_atendente_solicitacao';

	private $ats_codigo = 'ats_codigo';
	private $usu_codigo_atendente = 'usu_codigo_atendente';
	private $sol_codigo = 'sol_codigo';
	private $pri_codigo = 'pri_codigo';

	public function insert($dados)
	{

		$query = ("INSERT INTO $this->tabela
					($this->usu_codigo_atendente,$this->sol_codigo,$this->pri_codigo)
					VALUES(?,?,?)
					");
			
		$stmt = $this->conexao->prepare($query);

		$stmt->bindParam(1,$dados[$this->usu_codigo_atendente],PDO::PARAM_INT);
		$stmt->bindParam(2,$dados[$this->sol_codigo],PDO::PARAM_INT);
		$stmt->bindParam(3,$dados[$this->pri_codigo],PDO::PARAM_INT);

		$stmt->execute();

		return($stmt);

	}

	#Usado para confirmar se existe algu�m atendendo a solicita��o
	#para evitar q se criei dois atendimentos.
	public function confirmarAtendente($sol_codigo)
	{
		$query = ("SELECT $this->usu_codigo_atendente FROM $this->tabela
					WHERE $this->sol_codigo = ?");

		try
		{
			$stmt = $this->conexao->prepare($query);

			$stmt->bindParam(1,$sol_codigo,PDO::PARAM_INT);

			$stmt->execute();

			$dados = $stmt->fetch();

			return($dados[0]);

		} catch (PDOException $e)
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}
			
	}

	public function select($colum, $param = null)
	{

		$query = ("SELECT $this->usu_codigo_atendente FROM $this->tabela
					WHERE $this->sol_codigo = ?");

		try
		{
			$stmt = $this->conexao->prepare($query);

			$stmt->bindParam(1,$sol_codigo,PDO::PARAM_INT);

			$stmt->execute();

			$dados = $stmt->fetch();

			return($dados[0]);

		} catch (PDOException $e)
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}
	}

	#Retorna o nome do atendente da solicitacao
	public function getNomeAtendente($sol_codigo)
	{
		$query = ("SELECT usu_codigo_atendente, USU.usu_nome, sol_codigo
					FROM  tb_atendente_solicitacao
					INNER JOIN tb_usuario AS USU
					ON usu_codigo_atendente = usu_codigo
					WHERE sol_codigo = ?");

		try
		{
			$stmt = $this->conexao->prepare($query);

			$stmt->bindParam(1,$sol_codigo,PDO::PARAM_INT);

			$stmt->execute();

			$dados = $stmt->fetch();

			return($dados);

		} catch (PDOException $e)
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}
	}

	public function getForm($codigo_id_tabela){}

	#Atualiza o usuario que esta atendendo a solicitacao
	public function update($dados)
	{
		$query = ("UPDATE $this->tabela
					SET $this->usu_codigo_atendente = ?
					WHERE $this->sol_codigo = ?");
		
		try 
		{
			$stmt = $this->conexao->prepare($query);

			$stmt->bindParam(1,$dados['usu_codigo_atendente'],PDO::PARAM_INT);
			$stmt->bindParam(2,$dados['sol_codigo'],PDO::PARAM_INT);
			
			$stmt->execute();
			
		} catch (PDOException $e) 
		{
			throw new PDOException($e->getMessage(),$e->getCode());
		}
		
	}

}
?>