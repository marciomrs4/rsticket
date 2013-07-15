<?php

class TbProjeto extends Banco
{

	private $tabela = 'tb_projeto';

	private $pro_codigo          = 'pro_codigo';
	private $pro_cod_projeto     = 'pro_cod_projeto';
	private $pro_titulo          = 'pro_titulo';
	private $pro_descricao       = 'pro_descricao';
	private $pro_previsao_inicio = 'pro_previsao_inicio';
	private $pro_previsao_fim    = 'pro_previsao_fim';
	private $stp_codigo          = 'stp_codigo';
	private $usu_codigo          = 'usu_codigo';
	private $dep_codigo          = 'dep_codigo';


	public function insert($dados)
	{

		$query = ("INSERT INTO $this->tabela
					($this->pro_cod_projeto, $this->pro_titulo, $this->pro_descricao, $this->stp_codigo, 
					$this->usu_codigo, $this->dep_codigo, $this->pro_previsao_inicio, $this->pro_previsao_fim)
					VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
					$this->stp_codigo = 1;
					$this->usu_codigo = $_SESSION["usu_codigo"];
					$this->dep_codigo = $_SESSION["dep_codigo"];

					try{
						$stmt = $this->conexao->prepare($query);

						$stmt->bindParam(1,$dados[$this->pro_cod_projeto],PDO::PARAM_STR);
						$stmt->bindParam(2,$dados[$this->pro_titulo],PDO::PARAM_STR);
						$stmt->bindParam(3,$dados[$this->pro_descricao],PDO::PARAM_STR);
						$stmt->bindParam(4,$this->stp_codigo,PDO::PARAM_INT);
						$stmt->bindParam(5,$this->usu_codigo,PDO::PARAM_INT);
						$stmt->bindParam(6,$this->dep_codigo,PDO::PARAM_INT);
						$stmt->bindParam(7,$dados[$this->pro_previsao_inicio]);
						$stmt->bindParam(8,$dados[$this->pro_previsao_fim]);
							
						$stmt->execute();

						return($this->conexao->lastInsertId());

					}
					catch (PDOException $e)
					{
						throw new PDOException("Erro na tabela". get_class($this)."-". $e->getMessage(),$e->getCode());
					}

	}

	public function codigoProjeto()
	{
		$query = ("SELECT max($this->pro_codigo) FROM $this->tabela");

		try{
			$stmt = $this->conexao->prepare($query);

			$stmt->execute();
			$valor = $stmt->fetch();
			$ano = date("Y");
			$mes = date("m");
			$dia = date("d");
		  
			$codigo_projeto = $ano.$mes."00".$valor[0];

			return($codigo_projeto);
		}
		catch (PDOException $e)
		{
			throw new PDOException("Erro na tabela". get_class($this)."-". $e->getMessage(),$e->getCode());
		}

	}


	public function selectMeusProjetosAndamento($dep_codigo)
	{
		$query = ("SELECT
		           P.PRO_CODIGO,
                   P.PRO_COD_PROJETO AS Cуdigo, 
                   P.PRO_TITULO AS Titulo,
                   P.PRO_DESCRICAO AS Descriзгo,
                   P.PRO_PREVISAO_INICIO,
                   P.PRO_PREVISAO_FIM,
                   concat(U.USU_NOME, ' ', U.USU_SOBRENOME) AS Usuбrio,
                   S.STP_DESCRICAO AS Status
                   FROM tb_projeto AS P
                   JOIN tb_usuario AS U
                   ON U.USU_CODIGO = P.USU_CODIGO
                   JOIN tb_status_projeto AS S
                   ON S.STP_CODIGO = P.STP_CODIGO
                   WHERE P.DEP_CODIGO = ? AND P.STP_CODIGO = 2");

		try
		{
			$stmt = $this->conexao->prepare($query);

			$stmt->bindParam(1,$dep_codigo,PDO::PARAM_INT);
				
			$stmt->execute();
				
			return($stmt);
				
		} catch (PDOException $e)
		{
			throw new PDOException($e->getMessage(),$e->getCode());
		}
	}

	public function selectMeusProjetosCancelados($dep_codigo)
	{
		$query = ("SELECT
		           P.PRO_CODIGO,
                   P.PRO_COD_PROJETO AS Cуdigo, 
                   P.PRO_TITULO AS Titulo,
                   P.PRO_DESCRICAO AS Descriзгo,
                   P.PRO_PREVISAO_INICIO,
                   P.PRO_PREVISAO_FIM,
                   concat(U.USU_NOME, ' ', U.USU_SOBRENOME) AS Usuбrio,
                   S.STP_DESCRICAO AS Status
                   FROM tb_projeto AS P
                   JOIN tb_usuario AS U
                   ON U.USU_CODIGO = P.USU_CODIGO
                   JOIN tb_status_projeto AS S
                   ON S.STP_CODIGO = P.STP_CODIGO
                   WHERE P.DEP_CODIGO = ? AND P.STP_CODIGO = 3");

		try
		{
			$stmt = $this->conexao->prepare($query);

			$stmt->bindParam(1,$dep_codigo,PDO::PARAM_INT);
				
			$stmt->execute();
				
			return($stmt);
				
		} catch (PDOException $e)
		{
			throw new PDOException($e->getMessage(),$e->getCode());
		}
	}

	public function selectMeusProjetosConcluidos($dep_codigo)
	{
		$query = ("SELECT
		           P.PRO_CODIGO,
                   P.PRO_COD_PROJETO AS Cуdigo, 
                   P.PRO_TITULO AS Titulo,
                   P.PRO_DESCRICAO AS Descriзгo,
                   P.PRO_PREVISAO_INICIO,
                   P.PRO_PREVISAO_FIM,
                   concat(U.USU_NOME, ' ', U.USU_SOBRENOME) AS Usuбrio,
                   S.STP_DESCRICAO AS Status
                   FROM tb_projeto AS P
                   JOIN tb_usuario AS U
                   ON U.USU_CODIGO = P.USU_CODIGO
                   JOIN tb_status_projeto AS S
                   ON S.STP_CODIGO = P.STP_CODIGO
                   WHERE P.DEP_CODIGO = ? AND P.STP_CODIGO = 4");

		try
		{
			$stmt = $this->conexao->prepare($query);

			$stmt->bindParam(1,$dep_codigo,PDO::PARAM_INT);
				
			$stmt->execute();
				
			return($stmt);
				
		} catch (PDOException $e)
		{
			throw new PDOException($e->getMessage(),$e->getCode());
		}
	}
	
	public function selectMeusProjetosAprovacao($dep_codigo)
	{
		$query = ("SELECT
		           P.PRO_CODIGO,
                   P.PRO_COD_PROJETO AS Cуdigo, 
                   P.PRO_TITULO AS Titulo,
                   P.PRO_DESCRICAO AS Descriзгo,
                   P.PRO_PREVISAO_INICIO,
                   P.PRO_PREVISAO_FIM,
                   concat(U.USU_NOME, ' ', U.USU_SOBRENOME) AS Usuбrio,
                   S.STP_DESCRICAO AS Status
                   FROM tb_projeto AS P
                   JOIN tb_usuario AS U
                   ON U.USU_CODIGO = P.USU_CODIGO
                   JOIN tb_status_projeto AS S
                   ON S.STP_CODIGO = P.STP_CODIGO
                   WHERE P.DEP_CODIGO = ? AND P.STP_CODIGO = 1");

		try
		{
			$stmt = $this->conexao->prepare($query);

			$stmt->bindParam(1,$dep_codigo,PDO::PARAM_INT);
				
			$stmt->execute();
				
			return($stmt);
				
		} catch (PDOException $e)
		{
			throw new PDOException($e->getMessage(),$e->getCode());
		}
	}


	public function aprovarProjeto($dados)
	{
		$query = ("UPDATE $this->tabela
						SET $this->stp_codigo = ? 
						WHERE $this->pro_codigo = ? ");
		$dados['stp_codigo'] = 2;

		try{
			$stmt = $this->conexao->prepare($query);

			$stmt->bindParam(1, $dados['stp_codigo'], PDO::PARAM_INT);
			$stmt->bindParam(2, $dados['pro_codigo'], PDO::PARAM_INT);

			$stmt->execute();
		}
		catch (PDOException $e)
		{
			throw new PDOException("Erro na tabela". get_class($this)."-". $e->getMessage(),$e->getCode());
		}

	}

	public function update($dados)
	{
		$query = ("UPDATE $this->tabela
					SET $this->pro_titulo =?,
					$this->pro_descricao =?,
					$this->pro_previsao_inicio =?,
					$this->pro_previsao_fim =?,
					$this->stp_codigo = ?
						WHERE $this->pro_codigo = ? ");
					try
					{
						$stmt = $this->conexao->prepare($query);

						$stmt->bindParam(1,$dados[$this->pro_titulo],PDO::PARAM_STR);
						$stmt->bindParam(2,$dados[$this->pro_descricao],PDO::PARAM_STR);
						$stmt->bindParam(3,$dados[$this->pro_previsao_inicio]);
						$stmt->bindParam(4,$dados[$this->pro_previsao_fim]);
						$stmt->bindParam(5,$dados[$this->stp_codigo],PDO::PARAM_STR);
						$stmt->bindParam(6,$dados[$this->pro_codigo],PDO::PARAM_STR);
							
						$stmt->execute();

						return($stmt);

					} catch (PDOException $e)
					{
						throw new PDOException($e->getMessage(),$e->getCode());
					}

	}

	public function getFormAlteracao($pro_codigo)
	{
		$query = ("SELECT * FROM $this->tabela
					WHERE $this->pro_codigo = ?");

		try
		{
			$stmt = $this->conexao->prepare($query);
				
			$stmt->bindParam(1,$pro_codigo,PDO::PARAM_INT);
				
			$stmt->execute();
				
			$dados = $stmt->fetch();
				
			return($dados);
				
				
		}catch (PDOException $e)
		{
			throw new PDOException($e->getMessage(),$e->getCode());
		}

	}

}
?>