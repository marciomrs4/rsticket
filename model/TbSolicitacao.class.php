<?php

class TbSolicitacao extends Banco
{

	private $tabela = 'tb_solicitacao';

	private $sol_codigo = 'sol_codigo';
	private $pro_codigo = 'pro_codigo';
	private $sta_codigo = 'sta_codigo';
	private $usu_codigo_solicitante = 'usu_codigo_solicitante';
	private $dep_codigo_solicitado = 'dep_codigo_solicitado';
	private $sol_descricao_solicitacao = 'sol_descricao_solicitacao';

	public function insert($dados)
	{

		$query = ("INSERT INTO $this->tabela
						($this->pro_codigo, $this->sta_codigo, $this->usu_codigo_solicitante,
						$this->dep_codigo_solicitado, $this->sol_descricao_solicitacao)
					VALUES(?,?,?,?,?)
				  ");

						try
						{
							$stmt = $this->conexao->prepare($query);

							$stmt->bindParam(1,$dados[$this->pro_codigo],PDO::PARAM_INT);
							$stmt->bindParam(2,$dados[$this->sta_codigo],PDO::PARAM_INT);
							$stmt->bindParam(3,$dados[$this->usu_codigo_solicitante],PDO::PARAM_INT);
							$stmt->bindParam(4,$dados[$this->dep_codigo_solicitado],PDO::PARAM_INT);
							$stmt->bindParam(5,$dados[$this->sol_descricao_solicitacao],PDO::PARAM_STR);

							$stmt->execute();

							$this->sol_codigo =  $this->conexao->lastInsertId();

							return($this->sol_codigo);

						}catch (PDOException $e)
						{
							throw new PDOException("Erro na tabela ". get_class($this)."-". $e->getMessage(),$e->getCode());
						}

	}

	public function update($dados)
	{
		$query = ("UPDATE $this->tabela
					SET	$this->dep_codigo_solicitado = ?,
					$this->pro_codigo = ?,
					$this->sol_descricao_solicitacao = ?
					WHERE $this->sol_codigo = ? ");
					try
					{
						$stmt = $this->conexao->prepare($query);

						$stmt->bindParam(1,$dados[$this->dep_codigo_solicitado],PDO::PARAM_INT);
						$stmt->bindParam(2,$dados[$this->pro_codigo],PDO::PARAM_INT);
						$stmt->bindParam(3,$dados[$this->sol_descricao_solicitacao],PDO::PARAM_STR);
						$stmt->bindParam(4,$dados[$this->sol_codigo],PDO::PARAM_INT);
							
						$stmt->execute();

						return($stmt);

					} catch (PDOException $e)
					{
						throw new PDOException("Erro em TbSolicitacao".$e->getMessage(),$e->getCode());
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

	public function getFormReceptor($sol_codigo)
	{

		$query = ("SELECT sol_codigo,
						pro_codigo,
						sta_codigo,
						usu_codigo_solicitante,
						dep_codigo_solicitado as dep_codigo,
						sol_descricao_solicitacao 
					FROM  $this->tabela
				   		WHERE $this->sol_codigo = ?");

		try
		{
			$stmt = $this->conexao->prepare($query);

			$stmt->bindParam(1,$sol_codigo,PDO::PARAM_INT);

			$stmt->execute();

			return($stmt->fetch(PDO::FETCH_ASSOC));

		} catch (PDOException $e)
		{
			throw new PDOException($e->getMessage(),$e->getCode());
		}

	}


	#Metodo usado para mostrar a atividade no assentamento
	public function getFormAssentamento($sol_codigo)
	{

		$query = ("SELECT $this->sol_codigo, $this->sol_descricao_solicitacao, $this->sta_codigo
						FROM  $this->tabela
				   WHERE $this->sol_codigo = ?");

		try
		{
			$stmt = $this->conexao->prepare($query);

			$stmt->bindParam(1,$sol_codigo,PDO::PARAM_INT);

			$stmt->execute();

			$dados = $stmt->fetch();
			return($dados);

		} catch (PDOException $e)
		{
			throw new PDOException($e->getMessage(),$e->getCode());
		}

	}

	#Chamado que estou Atendendo; Chamados que estou atendendo
	public function selectMinhasTarefas($dados)
	{
		$query = ("SELECT SOL.sol_codigo, substr(PRO.pro_descricao,1,60), STA.sta_descricao,
				    USU.usu_nome AS Usuario_Solicitante,
				    (SELECT dep_descricao FROM tb_departamento WHERE dep_codigo = 
				        (SELECT dep_codigo FROM tb_usuario WHERE usu_codigo = usu_codigo_solicitante)
				    ) AS Departamento_Solicitante,
				    substr(sol_descricao_solicitacao,1,60), (SELECT usu_email FROM tb_usuario WHERE usu_codigo = ATS.usu_codigo_atendente) as Atendente,
	                (SELECT date_format(tea_data_acao,'%d-%m-%Y %H:%i:%s') FROM tb_calculo_atendimento WHERE sol_codigo = SOL.sol_codigo AND sta_codigo = 1) AS Abertura				    
				    from tb_solicitacao as SOL
				    #Traz o nome do usuario solicitante
				    INNER JOIN tb_usuario as USU
            		ON usu_codigo_solicitante = USU.usu_codigo
				    #Tabela de Problema, traz a descriчуo do problema
				    inner join tb_problema AS PRO
				    ON PRO.pro_codigo = SOL.pro_codigo
				    inner join tb_status STA
				    ON STA.sta_codigo = SOL.sta_codigo
				    #Tabela de Atendente Solicitacao, traz quem esta atendendo a solicitacao
				    left join tb_atendente_solicitacao as ATS
				    on SOL.sol_codigo = ATS.sol_codigo
				     WHERE  ATS.usu_codigo_atendente = ?
                    AND SOL.sta_codigo LIKE ? AND SOL.pro_codigo LIKE ?
                    AND usu_nome LIKE ? AND sol_descricao_solicitacao LIKE ?
				    ORDER BY SOL.sol_codigo DESC");
		try
		{
			$stmt = $this->conexao->prepare($query);

			$array = array($dados['usu_codigo_atendente'],
							"%{$dados[$this->sta_codigo]}%",
							"%{$dados[$this->pro_codigo]}%",
							"%{$dados['usu_nome']}%",
							"%{$dados[$this->sol_descricao_solicitacao]}%");


			$stmt->execute($array);

			return($stmt);

		} catch (PDOException $e)
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}
	}

	#Usado na opчуo, Chamados que abri
	public function selectMinhasSolicitacoes($dados)
	{
		$query = ("SELECT SOL.sol_codigo, substr(PRO.pro_descricao,1,60), STA.sta_descricao,
				     USU.usu_nome AS Usuario_Solicitante,
				    (SELECT dep_descricao FROM tb_departamento WHERE dep_codigo = 
				        (SELECT dep_codigo FROM tb_usuario WHERE usu_codigo = usu_codigo_solicitante)
				    ) AS Departamento_Solicitante,
				    substr(sol_descricao_solicitacao,1,60), (SELECT usu_email FROM tb_usuario WHERE usu_codigo = ATS.usu_codigo_atendente) as Atendente,
   	                (SELECT date_format(tea_data_acao,'%d-%m-%Y %H:%i:%s') FROM tb_calculo_atendimento WHERE sol_codigo = SOL.sol_codigo AND sta_codigo = 1) AS Abertura
				    FROM tb_solicitacao as SOL
				    #Traz o nome do usuario solicitante
				    INNER JOIN tb_usuario as USU
            		ON usu_codigo_solicitante = USU.usu_codigo
				    #Tabela de Problema, traz a descriчуo do problema
				    inner join tb_problema AS PRO
				    ON PRO.pro_codigo = SOL.pro_codigo
				    inner join tb_status STA
				    ON STA.sta_codigo = SOL.sta_codigo
				    #Tabela de Atendente Solicitacao, traz quem esta atendendo a solicitacao
				    LEFT JOIN tb_atendente_solicitacao as ATS
				    ON SOL.sol_codigo = ATS.sol_codigo
				    WHERE usu_codigo_solicitante = ?
                    AND SOL.sta_codigo LIKE ? AND SOL.pro_codigo LIKE ?
                    AND usu_nome LIKE ? AND sol_descricao_solicitacao LIKE ?
				    ORDER BY SOL.sol_codigo DESC");

		try
		{
			$stmt = $this->conexao->prepare($query);

			$array = array($dados[$this->usu_codigo_solicitante],
							"%{$dados[$this->sta_codigo]}%",
							"%{$dados[$this->pro_codigo]}%",
							"%{$dados['usu_nome']}%",
							"%{$dados[$this->sol_descricao_solicitacao]}%");

			$stmt->execute($array);

			return($stmt);

		} catch (PDOException $e)
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}
	}

	#Mostra os Chamados da area, por Status e Problema, TODOS CHAMADO PRA EQUIPE.
	public function selectSolicitacoesDepartmento($dados)
	{

		$query = ("SELECT SOL.sol_codigo, substr(PRO.pro_descricao,1,60), STA.sta_descricao,
				     USU.usu_nome AS Usuario_Solicitante,
				    (SELECT dep_descricao FROM tb_departamento WHERE dep_codigo = 
				        (SELECT dep_codigo FROM tb_usuario WHERE usu_codigo = usu_codigo_solicitante)
				    ) AS Departamento_Solicitante,
				    substr(sol_descricao_solicitacao,1,60), 
				    (SELECT usu_email FROM tb_usuario WHERE usu_codigo = ATS.usu_codigo_atendente) AS Atendente,
	                (SELECT date_format(tea_data_acao,'%d-%m-%Y %H:%i:%s') FROM tb_calculo_atendimento WHERE sol_codigo = SOL.sol_codigo AND sta_codigo = 1) AS Abertura				    
				    FROM tb_solicitacao AS SOL
				    #Traz o nome do usuario solicitante
				    INNER JOIN tb_usuario as USU
           			ON usu_codigo_solicitante = USU.usu_codigo
				    #Tabela de Problema, traz a descriчуo do problema
				    INNER JOIN tb_problema AS PRO
				    ON PRO.pro_codigo = SOL.pro_codigo
				    INNER JOIN tb_status STA
				    ON STA.sta_codigo = SOL.sta_codigo
				    #Tabela de Atendente Solicitacao, traz quem esta atendendo a solicitacao
				    LEFT JOIN tb_atendente_solicitacao AS ATS
				    ON SOL.sol_codigo = ATS.sol_codigo
				    WHERE dep_codigo_solicitado = ?
	                AND SOL.sta_codigo LIKE ? AND SOL.pro_codigo LIKE ?
                    AND usu_nome LIKE ? AND sol_descricao_solicitacao LIKE ?
				    ORDER BY SOL.sol_codigo DESC
				");
		try
		{
				
			$stmt = $this->conexao->prepare($query);

			$array = array($dados[$this->dep_codigo_solicitado],
							"%{$dados[$this->sta_codigo]}%",
							"%{$dados[$this->pro_codigo]}%",
							"%{$dados['usu_nome']}%",
							"%{$dados[$this->sol_descricao_solicitacao]}%");

			$stmt->execute($array);
			return($stmt);

		} catch (PDOException $e)
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}
	}

	#Mostra todos os Chamados da area, por Status e Problema; Usado na opчуo todos.
	public function selectSolicitacoesDepartmentoTodos($dados)
	{

		$query = ("SELECT SOL.sol_codigo, substr(PRO.pro_descricao,1,60), STA.sta_descricao,
				     USU.usu_nome AS Usuario_Solicitante,
				    (SELECT dep_descricao FROM tb_departamento WHERE dep_codigo = 
				        (SELECT dep_codigo FROM tb_usuario WHERE usu_codigo = usu_codigo_solicitante)
				    ) AS Departamento_Solicitante,
				    substr(sol_descricao_solicitacao,1,60), 
				    (SELECT usu_email FROM tb_usuario WHERE usu_codigo = ATS.usu_codigo_atendente) AS Atendente,
	                (SELECT date_format(tea_data_acao,'%d-%m-%Y %H:%i:%s') FROM tb_calculo_atendimento WHERE sol_codigo = SOL.sol_codigo AND sta_codigo = 1) AS Abertura
				    FROM tb_solicitacao AS SOL
				    #Traz o nome do usuario solicitante
				    INNER JOIN tb_usuario as USU
           			ON usu_codigo_solicitante = USU.usu_codigo
				    #Tabela de Problema, traz a descriчуo do problema
				    INNER JOIN tb_problema AS PRO
				    ON PRO.pro_codigo = SOL.pro_codigo
				    INNER JOIN tb_status STA
				    ON STA.sta_codigo = SOL.sta_codigo
				    #Tabela de Atendente Solicitacao, traz quem esta atendendo a solicitacao
				    LEFT JOIN tb_atendente_solicitacao AS ATS
				    ON SOL.sol_codigo = ATS.sol_codigo
				    WHERE dep_codigo_solicitado = ? OR usu_codigo_solicitante = ?
	                AND SOL.sta_codigo LIKE ? AND SOL.pro_codigo LIKE ?
                    AND usu_nome LIKE ? AND sol_descricao_solicitacao LIKE ?
				    ORDER BY SOL.sol_codigo DESC
				");
		try
		{
			$stmt = $this->conexao->prepare($query);

			$array = array($dados[$this->dep_codigo_solicitado],
			$dados[$this->usu_codigo_solicitante],
							"%{$dados[$this->sta_codigo]}%",
							"%{$dados[$this->pro_codigo]}%",
							"%{$dados['usu_nome']}%",
							"%{$dados[$this->sol_descricao_solicitacao]}%");

			$stmt->execute($array);
			return($stmt);

		} catch (PDOException $e)
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}
	}



	public function updateEncaminharExecutor($dados)
	{
		$query = ("UPDATE $this->tabela
					SET $this->usu_codigo_atendente = ?,
					$this->sta_codigo = ?,
					$this->sol_aprovacaogerencia = ?
					WHERE $this->sol_codigo = ?");
					try
					{
						$stmt = $this->conexao->prepare($query);
						$stmt->bindParam(1,$dados[$this->usu_codigo_atendente],PDO::PARAM_INT);
						$stmt->bindParam(2,$dados[$this->sta_codigo],PDO::PARAM_INT);
						$stmt->bindParam(3,$dados[$this->sol_aprovacaogerencia],PDO::PARAM_INT);
						$stmt->bindParam(4,$dados[$this->sol_codigo],PDO::PARAM_INT);
							
						$stmt->execute();
							
						return($stmt);
							
					} catch (PDOException $e)
					{
						throw new PDOException($e->getMessage(), $e->getCode());
					}
	}

	public function updateAtendimento($dados)
	{
		$query = ("UPDATE $this->tabela
					SET $this->sol_descricao_solucao = ?,
					$this->sta_codigo = ?,
					$this->sol_datafechamento = ?
					WHERE $this->sol_codigo = ?");
					try
					{
						$stmt = $this->conexao->prepare($query);
						$stmt->bindParam(1,$dados[$this->sol_descricao_solucao],PDO::PARAM_STR);
						$stmt->bindParam(2,$dados[$this->sta_codigo],PDO::PARAM_INT);
						$stmt->bindParam(3,$dados[$this->sol_datafechamento],PDO::PARAM_STR);
						$stmt->bindParam(4,$dados[$this->sol_codigo],PDO::PARAM_INT);
							
						$stmt->execute();
							
						return($stmt);
							
					} catch (PDOException $e)
					{
						throw new PDOException($e->getMessage(), $e->getCode());
					}
	}

	#Apenas solicitaчѕes para o Departamento
	public function selectSolicitacaoDepartamento($dep_codigo)
	{
		$query = ("SELECT SOL.sol_codigo, PRO.pro_descricao, STA.sta_descricao,
				    (SELECT usu_nome FROM tb_usuario WHERE usu_codigo = usu_codigo_solicitante) AS Usuario_Solicitante,
				    (SELECT dep_descricao FROM tb_departamento WHERE dep_codigo = 
				        (SELECT dep_codigo FROM tb_usuario WHERE usu_codigo = usu_codigo_solicitante)
				    ) AS Departamento_Solicitante,
				    sol_descricao_solicitacao, (SELECT usu_email FROM tb_usuario WHERE usu_codigo = ATS.usu_codigo_atendente) as Atendente
				    from tb_solicitacao as SOL
				    #Tabela de Problema, traz a descriчуo do problema
				    inner join tb_problema AS PRO
				    ON PRO.pro_codigo = SOL.pro_codigo
				    inner join tb_status STA
				    ON STA.sta_codigo = SOL.sta_codigo
				    #Tabela de Atendente Solicitacao, traz quem esta atendendo a solicitacao
				    left join tb_atendente_solicitacao as ATS
				    on SOL.sol_codigo = ATS.sol_codigo
				    WHERE dep_codigo_solicitado = ?
            ORDER BY sol_codigo DESC
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

	public function updateAprovarSolicitacao($dados)
	{
		$query = ("UPDATE $this->tabela
					SET $this->usu_codigo_gerencia = ?
					WHERE $this->sol_codigo = ?");
		try
		{
			$stmt = $this->conexao->prepare($query);

			$stmt->bindParam(1,$dados[$this->usu_codigo_gerencia],PDO::PARAM_INT);
			$stmt->bindParam(2,$dados[$this->sol_codigo],PDO::PARAM_INT);

			$stmt->execute();

			return($stmt);

		} catch (PDOException $e)
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}
	}

	#Verifica qual o problema da solicitacao, e retorna
	public function getProblema($sol_codigo)
	{
		$query = ("SELECT $this->pro_codigo FROM $this->tabela
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

	#Verifica qual o Departamento da solicitacao, e retorna
	public function getCodigoDepartamentoSolicitado($sol_codigo)
	{
		$query = ("SELECT $this->dep_codigo_solicitado FROM $this->tabela
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

	#Usado para alterar o status da solicitaчуo
	public function alterarStatus($dados)
	{
		$query = ("UPDATE $this->tabela
					SET $this->sta_codigo = ?
					WHERE $this->sol_codigo = ?");

		try
		{
			$stmt = $this->conexao->prepare($query);

			$stmt->bindParam(1, $dados[$this->sta_codigo],PDO::PARAM_INT);
			$stmt->bindParam(2, $dados[$this->sol_codigo],PDO::PARAM_STR);

			$stmt->execute();

			return($stmt);

		} catch (PDOException $e)
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}

	}

	#Lista a solicitaчѕes do Solicitante
	public function selectSolicitacoesSolicitante($dados)
	{

		$query = ("SELECT SOL.sol_codigo, PRO.pro_descricao, STA.sta_descricao,
				     USU.usu_nome AS Usuario_Solicitante,
                    (SELECT dep_descricao FROM tb_departamento WHERE dep_codigo = dep_codigo_solicitado) AS DEPTO_Solicitado,
				    substr(sol_descricao_solicitacao,1,60), 
				    (SELECT usu_email FROM tb_usuario WHERE usu_codigo = ATS.usu_codigo_atendente) AS Atendente
				    FROM tb_solicitacao AS SOL
				    #Traz o nome do usuario solicitante
				    INNER JOIN tb_usuario as USU
           			ON usu_codigo_solicitante = USU.usu_codigo
				    #Tabela de Problema, traz a descriчуo do problema
				    INNER JOIN tb_problema AS PRO
				    ON PRO.pro_codigo = SOL.pro_codigo
				    INNER JOIN tb_status STA
				    ON STA.sta_codigo = SOL.sta_codigo
				    #Tabela de Atendente Solicitacao, traz quem esta atendendo a solicitacao
				    LEFT JOIN tb_atendente_solicitacao AS ATS
				    ON SOL.sol_codigo = ATS.sol_codigo
				    WHERE dep_codigo_solicitado LIKE ?
	                AND SOL.sta_codigo LIKE ? AND SOL.pro_codigo LIKE ?
                    AND usu_nome LIKE ? AND sol_descricao_solicitacao LIKE ?
                    AND USU.dep_codigo = ?
				    ORDER BY SOL.sol_codigo DESC, SOL.sta_codigo DESC
				    LIMIT 50
                    
				");
		try
		{
			$stmt = $this->conexao->prepare($query);

			$array = array("%{$dados[$this->dep_codigo_solicitado]}%",
							"%{$dados[$this->sta_codigo]}%",
							"%{$dados[$this->pro_codigo]}%",
							"%{$dados['usu_nome']}%",
							"%{$dados[$this->sol_descricao_solicitacao]}%",
			$dados['dep_codigo']);

			$stmt->execute($array);
			return($stmt);

		} catch (PDOException $e)
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}
	}

	#Pega a Descriчуo do problema, prioridade e tempo de atendimento
	#Pra cada solicitacao
	public function getPrioridadeTempoAtendimento($sol_codigo)
	{

		$query = ("SELECT SOL.sol_codigo, PRO.pro_descricao, pri_descricao, tat_descricao
					FROM tb_solicitacao AS SOL
					INNER JOIN tb_problema AS PRO
					ON SOL.pro_codigo = PRO.pro_codigo
					INNER JOIN tb_prioridade AS PRI
					ON PRI.pri_codigo = PRO.pri_codigo
					INNER JOIN tb_tempo_atendimento TAT
					ON TAT.tat_codigo = PRI.tat_codigo
					WHERE SOL.sol_codigo = ?
				");
		try
		{
			$stmt = $this->conexao->prepare($query);

			$stmt->bindParam(1,$sol_codigo,PDO::PARAM_INT);
				
			$stmt->execute();
				
			return($stmt->fetch());

		} catch (PDOException $e)
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}
	}

	public function getStatus($sol_codigo)
	{
		$query = ("SELECT sta_codigo
					FROM tb_solicitacao 
					WHERE sol_codigo = ?");

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

	public function getUsuarioSolicitante($sol_codigo)
	{
		$query = ("SELECT $this->usu_codigo_solicitante
					FROM tb_solicitacao 
					WHERE sol_codigo = ?");

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

}
?>