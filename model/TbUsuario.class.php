<?php

class TbUsuario extends Banco
{

	private $tabela = 'tb_usuario';

	private $usu_codigo = 'usu_codigo';
	private $usu_nome = 'usu_nome';
	private $usu_sobrenome = 'usu_sobrenome';
	private $usu_email = 'usu_email';
	private $usu_ramal = 'usu_ramal';
	private $dep_codigo = 'dep_codigo';
	private $tac_codigo = 'tac_codigo';
	private $usu_cargo = 'usu_cargo';
	private $usu_drt = 'usu_drt';
	
	public function insert($dados)
	{
		
		
		$query = ("INSERT INTO $this->tabela 
					($this->usu_nome, $this->usu_sobrenome, $this->usu_email,
					 $this->usu_ramal, $this->dep_codigo, $this->tac_codigo)
					VALUES(?,?,?,?,?,?)
				  ");

		try{
			$stmt = $this->conexao->prepare($query);

			$stmt->bindParam(1,$dados[$this->usu_nome],PDO::PARAM_STR);
			$stmt->bindParam(2,$dados[$this->usu_sobrenome],PDO::PARAM_STR);
			$stmt->bindParam(3,$dados[$this->usu_email],PDO::PARAM_STR);
			$stmt->bindParam(4,$dados[$this->usu_ramal],PDO::PARAM_STR);
			$stmt->bindParam(5,$dados[$this->dep_codigo],PDO::PARAM_INT);
			$stmt->bindParam(6,$dados[$this->tac_codigo],PDO::PARAM_INT);															

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
					SET	$this->usu_nome = ?,
						$this->usu_sobrenome = ?,
						$this->usu_email = ?,
						$this->usu_ramal = ?,
						$this->dep_codigo = ?,
						$this->tac_codigo = ?
																										
					WHERE $this->usu_codigo = ? ");
		try
		{
			$stmt = $this->conexao->prepare($query);

			$stmt->bindParam(1,$dados[$this->usu_nome],PDO::PARAM_STR);
			$stmt->bindParam(2,$dados[$this->usu_sobrenome],PDO::PARAM_STR);
			$stmt->bindParam(3,$dados[$this->usu_email],PDO::PARAM_STR);
			$stmt->bindParam(4,$dados[$this->usu_ramal],PDO::PARAM_STR);
			$stmt->bindParam(5,$dados[$this->dep_codigo],PDO::PARAM_INT);
			$stmt->bindParam(6,$dados[$this->tac_codigo],PDO::PARAM_INT);
			$stmt->bindParam(7,$dados[$this->usu_codigo],PDO::PARAM_INT);

			$stmt->execute();

			return($stmt);

		} catch (PDOException $e)
		{
			throw new PDOException($e->getMessage(),$e->getCode());
		}

	}

	public function selectUsuarioDep($dep_codigo)
	{
		$query = ("SELECT $this->usu_codigo, $this->usu_nome, 
						  $this->usu_email, $this->usu_ramal 
					FROM tb_usuario
                    WHERE dep_codigo = ?
                    ");
		
		try 
		{
			$stmt = $this->conexao->prepare($query);
			
			$stmt->bindParam(1,$dep_codigo,PDO::PARAM_INT);
			
			$stmt->execute();
			
			return($stmt);
			
		} catch (PDOException $e) 
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}
		
	}
	
	public function selectUsuarios()
	{
		$query = ("SELECT usu_codigo, usu_nome, dep_descricao, tac_descricao
					FROM tb_usuario AS a
					INNER JOIN tb_departamento AS b
					ON a.dep_codigo = b.dep_codigo
					INNER JOIN tb_tipo_acesso AS c
					ON a.tac_codigo = c.tac_codigo
        		    WHERE usu_codigo != 1
				");
		
		try 
		{
			$stmt = $this->conexao->prepare($query);
			
			$stmt->execute();
			
			return($stmt);
			
		} catch (PDOException $e) 
		{
			throw new PDOException($e->getMessage(),$e->getCode());
		}
	}
	
	public function select($colum,$param)
	{
		$query = (" ");

		try
		{
			$stmt = $this->conexao->prepare($query);

			$stmt->execute();

			return($stmt);

		} catch (PDOException $e)
		{
			throw new PDOException($e->getMessage(),$e->getMessage());
		}
	}
	
	public function getUsuario($usu_codigo)
	{
		$query = ("SELECT $this->usu_nome, $this->usu_sobrenome, $this->usu_email,
						  $this->usu_ramal, $this->dep_codigo, $this->tac_codigo
    				FROM $this->tabela
    				WHERE $this->usu_codigo = ?
    			  ");

		try
		{
			$stmt = $this->conexao->prepare($query);
				
			$stmt->bindParam(1,$usu_codigo,PDO::PARAM_INT);
				
			$stmt->execute();
				
			return($stmt->fetch());

		} catch (PDOException $e)
		{
			throw new PDOException($e->getMessage(),$e->getMessage());
		}
	}
	
	public function getForm($usu_codigo)
	{

		$query = ("SELECT $this->usu_codigo, $this->usu_nome, $this->usu_sobrenome, $this->usu_email,
						  $this->usu_ramal, $this->dep_codigo, $this->tac_codigo 
						  FROM  $this->tabela 
				   		WHERE $this->usu_codigo = ?");

		try
		{
			$stmt = $this->conexao->prepare($query);

			$stmt->bindParam(1,$usu_codigo,PDO::PARAM_INT);

			$stmt->execute();

			return($stmt->fetch());

		} catch (PDOException $e)
		{
			throw new PDOException($e->getMessage(),$e->getCode());
		}

	}

	public function validaEmailUsuario($usu_email)
	{
		
		$query = ("SELECT $this->usu_codigo 
					FROM $this->tabela
					WHERE $this->usu_email = ?");
		
		try 
		{
			$stmt = $this->conexao->prepare($query);
			
			$stmt->bindParam(1,$usu_email,PDO::PARAM_STR);
			
			$stmt->execute();
			
			$dados = $stmt->fetch();
			
			return($dados[0]);
			
		} catch (PDOException $e) 
		{
			throw new PDOException($e->getMessage(),$e->getCode());
		}
		
	}
	
}
?>