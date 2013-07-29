<?php
class Alteracao extends Dados
{

	public function alterarUsuario()
	{
		try
		{
			ValidarCampos::campoVazio($this->dados['usu_nome'],'Nome');
			ValidarCampos::campoVazio($this->dados['usu_sobrenome'],'Sobrenome');

			ValidarString::validarEmail($this->dados['usu_email'],'E-mail');

			ValidarCampos::campoVazio($this->dados['usu_ramal'],$_SESSION['config']['ramal']);
			ValidarCampos::campoVazio($this->dados['dep_codigo'],'Departamento');
			ValidarCampos::campoVazio($this->dados['tac_codigo'],'Tipo de Acesso');


			$tbusuario = new TbUsuario();

			$tbusuario->update($this->dados);

		}catch (Exception $e)
		{
			throw new Exception($e->getMessage(), $e->getCode());
		}
	}

	public function alterarUsuarioSenha()
	{
		try
		{
			ValidarCampos::campoVazio($this->dados['ace_usuario'],$_SESSION['config']['usuario']);
			ValidarCampos::campoVazio($this->dados['ace_senha'],$_SESSION['config']['senha']);
			ValidarCampos::campoVazio($this->dados['ace_senha2'],'Repetir '.$_SESSION['config']['senha']);

			ValidarCampos::compararCampos($this->dados['ace_senha'],$this->dados['ace_senha2'],$_SESSION['config']['senha'].' e Repetir '.$_SESSION['config']['senha']);

			ValidarCampos::validarQtdCaracter($this->dados['ace_senha'],6,$_SESSION['config']['senha']);

			$this->dados['ace_senha'] = Validacao::hashSenha($this->dados['ace_senha']);

			$tbacesso = new TbAcesso();
			$tbacesso->update($this->dados);

		} catch (Exception $e)
		{
			throw new Exception($e->getMessage(), $e->getCode());
		}
	}

	public function alterarMinhaSenha()
	{
		try
		{

			ValidarCampos::campoVazio($this->dados['ace_senha'],$_SESSION['config']['senha']);
			ValidarCampos::campoVazio($this->dados['ace_senha2'],'Repetir '.$_SESSION['config']['senha']);

			ValidarCampos::compararCampos($this->dados['ace_senha'],$this->dados['ace_senha2'],$_SESSION['config']['senha'].' e Repetir '.$_SESSION['config']['senha']);

			ValidarCampos::validarQtdCaracter($this->dados['ace_senha'],6,$_SESSION['config']['senha']);

			$this->dados['ace_senha'] = Validacao::hashSenha($this->dados['ace_senha']);

			$tbacesso = new TbAcesso();
			$tbacesso->alterarMinhaSenha($this->dados);

		} catch (Exception $e)
		{
			throw new Exception($e->getMessage(), $e->getCode());
		}
	}


	public function alterarDepartamento()
	{
		try
		{
			ValidarCampos::campoVazio($this->dados['dep_descricao'],'Departamento');
			ValidarCampos::campoVazio($this->dados['dep_email'],'E-mail');

			ValidarString::validarEmail($this->dados['dep_email'],'E-mail');

			$tbdepartamento = new TbDepartamento();

			$tbdepartamento->update($this->dados);

		}catch (Exception $e)
		{
			throw new Exception($e->getMessage(), $e->getCode());
		}
	}


	public function aprovarProjeto($pro_codigo)
	{
		$this->dados['pro_codigo'] = $pro_codigo;

		try
		{
			$tbprojeto = new TbProjeto();

			$tbprojeto->aprovarProjeto($this->dados);

		}catch (Exception $e)
		{
			throw new Exception($e->getMessage(), $e->getCode());
		}
	}

	public function alterarProjeto()
	{
		try
		{
			ValidarCampos::campoVazio($this->dados['pro_titulo'],'Titulo');
			ValidarCampos::campoVazio($this->dados['pro_descricao'],'Descriзгo');
			ValidarCampos::campoVazio($this->dados['pro_previsao_inicio'],'Previsгo Inicio');
			ValidarCampos::campoVazio($this->dados['pro_previsao_fim'],'Previsгo Fim');

			$this->dados['pro_previsao_inicio'] = ValidarDatas::dataBanco($this->dados['pro_previsao_inicio']);
			$this->dados['pro_previsao_fim'] = ValidarDatas::dataBanco($this->dados['pro_previsao_fim']);


			$tbprojeto = new TbProjeto();

			$tbprojeto->update($this->dados);

		}catch (Exception $e)
		{
			throw new Exception($e->getMessage(), $e->getCode());
		}
	}


	public function alterarMeuTempo()
	{
		try
		{
			ValidarCampos::campoVazio($this->dados['tat_descricao'],'Tempo de Atendimento');

			$tbtempoatendimento = new TbTempoAtendimento();
			$tbtempoatendimento->update($this->dados);

		}catch (Exception $e)
		{
			throw new Exception($e->getMessage(), $e->getCode());
		}

	}

	public function alterarPrioridade()
	{
		try
		{
			ValidarCampos::campoVazio($this->dados['pri_descricao'],'Prioridade');
			ValidarCampos::campoVazio($this->dados['tat_codigo'],'Tempo de Atendimento');
				
			ValidarCampos::campoVazio($this->dados['dep_codigo_prioridade'],'Tempo de Atendimento');

			$this->dados['dep_codigo'] = $this->dados['dep_codigo_prioridade'];
				

			$tbprioridade = new TbPrioridade();
			$tbprioridade->update($this->dados);

		}catch (Exception $e)
		{
			throw new Exception($e->getMessage(), $e->getCode());
		}
	}

	public function alterarProblema()
	{
		try
		{
			ValidarCampos::campoVazio($this->dados['pro_descricao'],'Descricao');
			ValidarCampos::campoVazio($this->dados['pri_codigo'],'Prioridade');
			ValidarCampos::campoVazio($this->dados['dep_codigo_problema'],'Departamento');

			$this->dados['dep_codigo'] = $this->dados['dep_codigo_problema'];

			$tbproblema = new TbProblema();
			$tbproblema->update($this->dados);

		} catch (Exception $e)
		{
			throw new Exception($e->getMessage(), $e->getCode());
		}
	}

	public function alterarStatus()
	{
		try
		{
			ValidarCampos::campoVazio($this->dados['sta_descricao'],'Status');

			$tbstatus = new TbStatus();
			$tbstatus->update($this->dados);

		} catch (Exception $e)
		{
			throw new Exception($e->getMessage(), $e->getCode());
		}
	}

	public function alterarEncaminharSolicitacao()
	{
		try
		{
			ValidarCampos::campoVazio($this->dados['usu_codigo_atendente'],'Encaminhar para');


			$tbsolicitacao = new TbSolicitacao();
			$tbsolicitacao->updateEncaminharExecutor($this->dados);

		}catch (Exception $e)
		{
			throw new Exception($e->getMessage(), $e->getCode());
		}

	}

	/**
	 *
	 * Usadao para alterar a solicitaзгo...
	 * @throws Exception
	 */
	public function alterarSolicitacao($file)
	{
		try
		{
			ValidarCampos::campoVazio($this->dados['dep_codigo'],'Departamento');
			ValidarCampos::campoVazio($this->dados['pro_codigo'],$_SESSION['config']['problema']);
			ValidarCampos::campoVazio($this->dados['sol_descricao_solicitacao'],'Descriзгo do '.$_SESSION['config']['problema']);

			ValidarCampos::validarQtdCaracter($this->dados['sol_descricao_solicitacao'],10,'Descriзгo do '.$_SESSION['config']['problema']);

			#Capturando o cуdigo do DEPTO solicitado
			$this->dados['dep_codigo_solicitado'] = $this->dados['dep_codigo'];

			try
			{
				$this->conexao->beginTransaction();

			if($file['tmp_name'] != '')
			{
					
				$tbanexo = new TbAnexo();
				$tbarquivo = new Arquivo();

				#Instancia da classe Arquivo que manipula os aquivos
				$arquivo = new Arquivo();
				#Metodo setDados que serve para setar o $file que contйm todo o arquivo
				$arquivo->setDados($file);
				/*
				 * Capturando os dados do arquivo
				 */
				$this->dados['ane_anexo'] = $arquivo->arquivoBinario();
				$this->dados['ane_nome'] = $arquivo->arquivoNome();
				$this->dados['ane_tamanho'] = $arquivo->arquivoTamanho();
				$this->dados['ane_tipo'] = $arquivo->arquivoTipo();


				if($tbanexo->confirmarAnexo($this->dados['sol_codigo']))
				{
					$tbanexo->update($this->dados);

				}else
				{
					$tbanexo->insert($this->dados);
				}
			}


			$tbsolicitacao = new TbSolicitacao();
			$tbsolicitacao->update($this->dados);
			
			$this->conexao->commit();

			}catch (PDOException $e)
			{
				$this->conexao->rollBack();
				throw new PDOException($e->getMessage(), $e->getCode());
			}
			
		}catch (Exception $e)
		{
			throw new Exception($e->getMessage(), $e->getCode());
		}
	}

	public function alterarAtendimentoSolicitacao()
	{

		try
		{

			ValidarCampos::campoVazio($this->dados['sol_descricao_solucao'],'Descriзгo da Soluзгo');
			ValidarCampos::validarQtdCaracter($this->dados['sol_descricao_solucao'],10,'Descriзгo da Soluзгo');

			ValidarCampos::campoVazio($this->dados['sta_codigo'],'Status');

			$this->dados['sol_datafechamento'] = date('Y-m-d');

			$tbsolicitacao = new TbSolicitacao();
			$tbsolicitacao->updateAtendimento($this->dados);

		}catch (Exception $e)
		{
			throw new Exception($e->getMessage(), $e->getCode());
		}

	}

	public function alterarAprovarSolicitacao($usu_codigo_gerencia)
	{

		$this->dados['usu_codigo_gerencia'] = $usu_codigo_gerencia;

		try
		{

			$tbsolicitacao = new TbSolicitacao();
			$tbsolicitacao->updateAprovarSolicitacao($this->dados);

		}catch (Exception $e)
		{
			throw new Exception($e->getMessage(), $e->getCode());
		}

	}

	public function alterarLayout($usu_codigo)
	{

		$layout = new TbLayout();
		$this->dados['usu_codigo'] = $usu_codigo;

		try
		{
			if($this->dados['cadastrar'] == '')
			{
				$layout->updateLayoutDefault($usu_codigo);

			}else
			{
				$layout->updateLayout($this->dados);
			}


		} catch (PDOException $e)
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}
	}

	public function alterarAtenderChamado($sol_codigo)
	{
		try
		{

			$tbatendentesol = new TbAtendenteSolicitacao();

			$atendente = $tbatendentesol->confirmarAtendente($sol_codigo);

			try
			{

					
				if($atendente)
				{
					throw new Exception('Jб existe um atendente para a ocorrкncia','300');
				}else
				{

					try
					{
						$tbsolicitacao = new TbSolicitacao();
						$tbproblema = new TbProblema();

						#Inicia a transaзгo
						$this->conexao->beginTransaction();

						#Pega o codigo do problema da solicitacao
						$pro_codigo = $tbsolicitacao->getProblema($sol_codigo);
						#Com o codigo do problema eu pego o codigo da prioridade para
						#Colocar na tabela de atendente
						$pri_codigo = $tbproblema->getPrioridade($pro_codigo);

						$this->dados['usu_codigo_atendente'] = $_SESSION['usu_codigo'];
						$this->dados['sol_codigo'] = $sol_codigo;
						$this->dados['pri_codigo'] = $pri_codigo;
						#Insere na tabela de atendente_solicitacao quem esta atedendendo
						$tbatendentesol->insert($this->dados);

						#Altera o status da solicitacao para "Em atendimento"
						$this->dados['sta_codigo'] = 2;
						$tbsolicitacao->alterarStatus($this->dados);

						#Grava a alteraзгo no Calculo de Atendimento
						$tbcalculoatendimento = new TbCalculoAtendimento();
						$tbcalculoatendimento->insertCalculoAtendimento($this->dados);
						
						$tbassentamento = new TbAssentamento();
						$this->dados['ass_descricao'] = 'Em atendimento';
						$this->dados['usu_codigo'] = $_SESSION['usu_codigo'];
						$tbassentamento->insert($this->dados);

						#Faz commit no banco caso sucesso
						$this->conexao->commit();
						
						#Enviando e-mail quando atender chamado
						$email = new Email();
						$email->interacaoAssentamento($this->dados);
						

					}catch (PDOException $e)
					{
						#Faz Rollback em caso de falha
						$this->conexao->rollBack();

						throw new PDOException($e->getMessage(), $e->getCode());
					}
				}

			}catch (Exception $e)
			{
				throw new Exception($e->getMessage(),$e->getCode());
			}


		} catch (PDOException $e)
		{
			throw new PDOException($e->getMessage(), $e->getCode());
		}

	}

	public function alterarAssentamento()
	{
		try
		{
			/* ass_descricao, ass_data_cadastro, sol_codigo, usu_codigo*/

			ValidarCampos::campoVazio($this->dados['ass_descricao'],'Descriзгo');

			$tbassentamento = new TbAssentamento();
			$tbassentamento->alterarDescricao($dados);


		} catch (Exception $e)
		{
			throw new Exception($e->getMessage(), $e->getCode());
		}
	}

	public function alterarChecklist()
	{
		try
		{
			ValidarCampos::campoVazio($this->dados['che_titulo'],'Titulo');
			ValidarCampos::campoVazio($this->dados['che_email_envio'],'E-mail de Envio');
			ValidarCampos::campoVazio($this->dados['che_descricao'],'Descriзгo');
			ValidarCampos::campoVazio($this->dados['dep_codigo'],'Departamento');

			ValidarString::validarEmail($this->dados['che_email_envio'],'E-mail com sintaxe incorreta');

			$this->dados['usu_codigo'] = $_SESSION['usu_codigo'];

			try
			{

				#Instancia do obj
				$tbchecklist = new TbChecklist();

				if($this->dados['alterar'])
				{
					#Atualiza
					$tbchecklist->update($this->dados);
						
				}else
				{
					#Delete caso contario
					$tbchecklist->delete($this->dados['che_codigo']);
				}

			} catch (PDOException $e)
			{
				throw new PDOException($e->getMessage(), $e->getCode());
			}

		} catch (Exception $e)
		{
			throw new Exception($e->getMessage(), $e->getCode());
		}
	}

	public function alterarItemChecklist($file)
	{

		if($this->dados['alterar'])
		{

			try
			{

				ValidarCampos::campoVazio($this->dados['ich_titulo_tarefa'],'Tarefa');
				//ValidarCampos::campoVazio($this->dados['ich_link'],'');
				//$this->dados['ich_ativo']

				try
				{
					$this->conexao->beginTransaction();

					$tbitemcklist = new TbItemChecklist();
					$tbitemcklist->update($this->dados);

					if($file['tmp_name'] != '')
					{
						#Instancia da classe Arquivo que manipula os aquivos
						$arquivo = new Arquivo();
						#Metodo setDados que serve para setar o $file que contйm todo o arquivo
						$arquivo->setDados($file);
						/*
						 * Capturando os dados do arquivo
						 */
						$this->dados['ane_anexo'] = $arquivo->arquivoBinario();
						$this->dados['ane_nome'] = $arquivo->arquivoNome();
						$this->dados['ane_tamanho'] = $arquivo->arquivoTamanho();
						$this->dados['ane_tipo'] = $arquivo->arquivoTipo();

						#Instancia a classe de Anexo do CheckList
						$tbanexocklist = new TbAnexoCheckList();
							
						#Verifica se existe um anexo pra esste item
						if($this->dados['ane_codigo'])
						{
							#Se jб existe, altera o anexo do checklist
							$tbanexocklist->update($this->dados);
						}else
						{
							#Se nгo existe, grava o anexo do checklist
							$tbanexocklist->insert($this->dados);
						}
							
					}

					$this->conexao->commit();

				} catch (PDOException $e)
				{
					$this->conexao->rollBack();

					throw new PDOException($e->getMessage(), $e->getCode());
				}
					
					
			} catch (Exception $e)
			{
				throw new Exception($e->getMessage(), $e->getCode());
			}

		}else
		{
			try
			{
			$tbitemcklist = new TbItemChecklist();
			$tbitemcklist->delete($this->dados['ich_codigo']);
			}catch (PDOException $e)
			{
				throw new PDOException($e->getMessage(), $e->getCode());
			}
		}

	}

}
?>