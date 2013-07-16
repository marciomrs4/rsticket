<?php
class Cadastro extends Dados
{

	public function cadastrarUsuario()
	{
		try
		{

			ValidarCampos::campoVazio($this->dados['usu_nome'],'Nome');
			ValidarCampos::campoVazio($this->dados['usu_sobrenome'],'Sobrenome');

			ValidarString::validarEmail($this->dados['usu_email'],'E-mail');

			ValidarCampos::campoVazio($this->dados['usu_ramal'],'Ramal');
			ValidarCampos::campoVazio($this->dados['dep_codigo'],'Departamento');
			ValidarCampos::campoVazio($this->dados['tac_codigo'],'Tipo de Acesso');
			ValidarCampos::campoVazio($this->dados['ace_usuario'],'Usuário');

			ValidarCampos::campoVazio($this->dados['ace_senha'],'Senha');
			ValidarCampos::campoVazio($this->dados['ace_senha2'],'Repetir Senha');

			ValidarCampos::validarQtdCaracter($this->dados['ace_senha'],6,'Senha');

			ValidarCampos::compararCampos($this->dados['ace_senha'],$this->dados['ace_senha2'],'Senha e Repetir Senha');

			$this->dados['ace_senha'] = Validacao::hashSenha($this->dados['ace_senha']);



			try
			{
					
				$this->conexao->beginTransaction();
					
				$tbusuario = new TbUsuario();
				$this->dados['usu_codigo'] = $tbusuario->insert($this->dados);
					
				$tbacesso = new TbAcesso();
				$tbacesso->insert($this->dados);

				#Cria o layout padrão para o usuário
				$tblayout = new TbLayout();
				$tblayout->insertLayout($this->dados['usu_codigo']);
					
				$this->conexao->commit();
					
			}catch (PDOException $e)
			{
				$this->conexao->rollBack();
				throw new PDOException($e->getMessage(), $e->getCode());
			}
		} catch (Exception $e)
		{

			throw new Exception($e->getMessage(),$e->getCode());
		}

	}



	public function cadastrarDepartamento()
	{
		try
		{

			ValidarCampos::campoVazio($this->dados['dep_descricao'],'Departamento');
			ValidarCampos::campoVazio($this->dados['dep_email'],'E-Mail');

			ValidarString::validarEmail($this->dados['dep_email'],'E-mail');

			try
			{
					
				$this->conexao->beginTransaction();
					
				$tbdepartamento = new TbDepartamento();
				$this->dados['dep_codigo'] = $tbdepartamento->insert($this->dados);
					
				//				$tbacesso = new TbAcesso();
				//				$tbacesso->insert($this->dados);

				#Cria o layout padrão para o usuário
				//				$tblayout = new TbLayout();
				//				$tblayout->insertLayout($this->dados['usu_codigo']);
					
				$this->conexao->commit();
					
			}catch (PDOException $e)
			{
				$this->conexao->rollBack();
				throw new PDOException($e->getMessage(), $e->getCode());
			}
		} catch (Exception $e)
		{

			throw new Exception($e->getMessage(),$e->getCode());
		}

	}


	public function cadastrarProjeto()
	{
		try
		{

			ValidarCampos::campoVazio($this->dados['pro_titulo'],'Titulo');
			ValidarCampos::campoVazio($this->dados['pro_descricao'],'Descrição');
			ValidarCampos::campoVazio($this->dados['pro_previsao_inicio'],'Previsão Inicio');
			ValidarCampos::campoVazio($this->dados['pro_previsao_fim'],'Previsão Fim');
				
			$this->dados['pro_previsao_inicio'] = ValidarDatas::dataBanco($this->dados['pro_previsao_inicio']);
			$this->dados['pro_previsao_fim'] = ValidarDatas::dataBanco($this->dados['pro_previsao_fim']);
				
			try
			{
					
				$this->conexao->beginTransaction();

				$tbprojeto = new TbProjeto();
				$this->dados['pro_codigo'] = $tbprojeto->insert($this->dados);

				$this->conexao->commit();
					
			}catch (PDOException $e)
			{
				$this->conexao->rollBack();
				throw new PDOException($e->getMessage(), $e->getCode());
			}
		} catch (Exception $e)
		{

			throw new Exception($e->getMessage(),$e->getCode());
		}

	}



	public function cadastrarTempo()
	{
		try
		{
			ValidarCampos::campoVazio($this->dados['tat_descricao'],'Tempo de Atendimento');
			ValidarCampos::campoVazio($this->dados['dep_codigo'],'Departamento');
				

			$tbtempoatendimento = new TbTempoAtendimento();
			$tbtempoatendimento->insert($this->dados);

		}catch (Exception $e)
		{
			throw new Exception($e->getMessage(), $e->getCode());
		}
	}

	public function cadastrarPrioridade()
	{
		try
		{
			ValidarCampos::campoVazio($this->dados['pri_descricao'],'Prioridade');
			ValidarCampos::campoVazio($this->dados['tat_codigo'],'Tempo de Atendimento');
			
			ValidarCampos::campoVazio($this->dados['dep_codigo_prioridade'],'Tempo de Atendimento');

			$this->dados['dep_codigo'] = $this->dados['dep_codigo_prioridade'];
			
			$tbprioridade = new TbPrioridade();
			$tbprioridade->insert($this->dados);

		}catch (Exception $e)
		{
			throw new Exception($e->getMessage(), $e->getCode());
		}
	}

	public function cadastrarProblema()
	{
		try
		{

			ValidarCampos::campoVazio($this->dados['pro_descricao'],'Problema');
			ValidarCampos::campoVazio($this->dados['dep_codigo_problema'],'Departamento');
			ValidarCampos::campoVazio($this->dados['pri_codigo'],'Prioridade');
			
			$this->dados['dep_codigo'] = $this->dados['dep_codigo_problema'];

			$tbproblema = new TbProblema();
			$tbproblema->insert($this->dados);

		} catch (Exception $e)
		{
			throw new Exception($e->getMessage(), $e->getCode());
		}
	}

	public function cadastrarStatus($dep_codigo)
	{
		try
		{
			ValidarCampos::campoVazio($this->dados['sta_descricao'],'Status');

			$this->dados['dep_codigo'] = $dep_codigo;

			$tbstatus = new TbStatus();
			$tbstatus->insert($this->dados);

		} catch (Exception $e)
		{
			throw new Exception($e->getMessage(), $e->getCode());
		}
	}

	/**
	 *
	 * Enter description here ...
	 * @param unknown_type $usu_codigo_solicitante
	 * @param unknown_type $file
	 * @throws PDOException
	 * @throws Exception
	 * @example para cadastrar uma solicitação são necessarios 3 tabelas
	 * 1 - tb_solicitacao
	 * 2 - tb_anexo [Não obrigatório
	 * 3 - tb_calculo_atendimento
	 * 	1: Grava os dados da solicitacao
	 * 	2: Grava um anexo da solicitação se houver
	 * 	3: Grava a data de criação para o acompanhamento da solicitação
	 */
	public function cadastrarSolicitacao($usu_codigo_solicitante,$file)
	{
		try
		{

			#Metodos de validação
			ValidarCampos::campoVazio($this->dados['dep_codigo'],'Departamento');
			ValidarCampos::campoVazio($this->dados['pro_codigo'],'Problema');
			ValidarCampos::campoVazio($this->dados['sol_descricao_solicitacao'],'Descrição do Problema');
			ValidarCampos::validarQtdCaracter($this->dados['sol_descricao_solicitacao'],5,'Descrição do Problema');
			$this->dados['sol_descricao_solicitacao'] = strip_tags($this->dados['sol_descricao_solicitacao']);
			#Capturando o codigo do usuário solicitante
			$this->dados['usu_codigo_solicitante'] = $usu_codigo_solicitante;
			#Capturando o código do DEPTO solicitado
			$this->dados['dep_codigo_solicitado'] = $this->dados['dep_codigo'];
			#Capta o status do chamado, no caso em atendimento
			$this->dados['sta_codigo'] = 1;
				
			try
			{
					
				#Inicia a transação
				$this->conexao->beginTransaction();
					
				#Grava na tabela de solicitacao
				$tbsolicitacao = new TbSolicitacao();
				$this->dados['sol_codigo'] = $tbsolicitacao->insert($this->dados);
				
				if($file['tmp_name'] != '')
				{
					#Instancia da classe Arquivo que manipula os aquivos
					$arquivo = new Arquivo();
					#Metodo setDados que serve para setar o $file que contém todo o arquivo
					$arquivo->setDados($file);
					/*
					 * Capturando os dados do arquivo
					 */
					$this->dados['ane_anexo'] = $arquivo->arquivoBinario();
					$this->dados['ane_nome'] = $arquivo->arquivoNome();
					$this->dados['ane_tamanho'] = $arquivo->arquivoTamanho();
					$this->dados['ane_tipo'] = $arquivo->arquivoTipo();

					#Gravando o arquivo no banco dentro da tabela de anexo
					$tbanexo = new TbAnexo();
					$tbanexo->insert($this->dados);
				}

				#Grava a data de abertura da solicitação
				$tbcalculoatendimento = new TbCalculoAtendimento();
				$tbcalculoatendimento->insertCalculoAtendimento($this->dados);
				
				#Se tudo deu certo, faz commit
				$this->conexao->commit();

			}catch (PDOException $e)
			{
				#Se algo deu errado faz o rollBack
				$this->conexao->rollBack();
				#Lança uma exeção do tipo PDOException
				throw new PDOException($e->getMessage(), $e->getCode());
			}



		}catch (Exception $e)
		{
			#Lança uma exceção do tipo Exception
			throw new Exception($e->getMessage(), $e->getCode());
		}
	}

	public function cadastrarAssentamento()
	{
		try
		{
			/* ass_descricao, ass_data_cadastro, sol_codigo, usu_codigo*/
				
			ValidarCampos::campoVazio($this->dados['ass_descricao'],'Descrição');
			ValidarCampos::campoVazio($this->dados['usu_codigo_atendente'],'Atendente do Chamado');
				
			$this->dados['usu_codigo'] = $_SESSION['usu_codigo'];
				
			$this->dados['sta_codigo'];
				
			try
			{
				$tbassentamento = new TbAssentamento();
				$tbsolicitacao = new TbSolicitacao();
				$tbatendente = new TbAtendenteSolicitacao();
				$tbproblema = new TbProblema();

				#Inicia a transção
				$this->conexao->beginTransaction();

				if($tbatendente->confirmarAtendente($this->dados['sol_codigo']))
				{
					$tbatendente->update($this->dados);
						
				}else{
						
					#Pega o codigo do problema da solicitacao
					$pro_codigo = $tbsolicitacao->getProblema($this->dados['sol_codigo']);

					#Com o codigo do problema eu pego o codigo da prioridade para
					#Colocar na tabela de atendente
					$this->dados['pri_codigo'] = $tbproblema->getPrioridade($pro_codigo);
						
					$tbatendente->insert($this->dados);
				}


				$tbassentamento->insert($this->dados);
				$tbsolicitacao->alterarStatus($this->dados);

				#Instancia da Classe CalculoAtendimento
				$tbcalculoatendimento = new TbCalculoAtendimento();				
				#Grava a data de abertura da solicitação

				if($tbcalculoatendimento->verificaEmAndamento($this->dados))
				{}else
				{
					$tbcalculoatendimento->insertCalculoAtendimento($this->dados);
				}
				
				#Faz commit se tudo deu certo
				$this->conexao->commit();

			} catch (Exception $e)
			{
				#Faz Rollback se algo der errado
				$this->conexao->rollBack();
				throw new PDOException($e->getMessage(), $e->getCode());
			}
				
				
		} catch (Exception $e)
		{
			throw new Exception($e->getMessage(), $e->getCode());
		}
	}

	public function cadastrarAssentamentoSolicitante()
	{
		try
		{
				
			ValidarCampos::campoVazio($this->dados['ass_descricao'],'Descrição');
				
			$this->dados['usu_codigo'] = $_SESSION['usu_codigo'];
				
			$this->dados['sta_codigo'] = ($this->dados['sta_codigo'] == '') ? $this->dados['sta_codigo'] : 3;
				
			try
			{
				$tbassentamento = new TbAssentamento();
				$tbsolicitacao = new TbSolicitacao();
				$tbproblema = new TbProblema();

				#Inicia a transção
				$this->conexao->beginTransaction();

				#Insere um assentamento
				$tbassentamento->insert($this->dados);
				
				if($this->dados['sta_codigo'] == 3)
				{
					#Alterar status da solicitação
					$tbsolicitacao->alterarStatus($this->dados);
					
					#Grava a data de alteracao de status da solicitação 
					$tbcalculoatendimento = new TbCalculoAtendimento();
					$tbcalculoatendimento->insertCalculoAtendimento($this->dados);
					
				}
				
				#Faz commit se tudo deu certo
				$this->conexao->commit();

			} catch (Exception $e)
			{
				#Faz Rollback se algo der errado
				$this->conexao->rollBack();
				throw new PDOException($e->getMessage(), $e->getCode());
			}
				
				
		} catch (Exception $e)
		{
			throw new Exception($e->getMessage(), $e->getCode());
		}
	}
	
	public function cadastrarChecklist()
	{
		try 
		{
			ValidarCampos::campoVazio($this->dados['che_titulo'],'Titulo');
			ValidarCampos::campoVazio($this->dados['che_email_envio'],'E-mail de Envio');			
			ValidarCampos::campoVazio($this->dados['che_descricao'],'Descrição');			
			ValidarCampos::campoVazio($this->dados['dep_codigo'],'Departamento');			

			ValidarString::validarEmail($this->dados['che_email_envio'],'E-mail com sintaxe incorreta');
			
			$this->dados['usu_codigo'] = $_SESSION['usu_codigo'];
			
			try 
			{
				$tbchecklist = new TbChecklist();
				
				$tbchecklist->insert($this->dados);
				
			} catch (PDOException $e) 
			{
				throw new PDOException($e->getMessage(), $e->getCode());
			}
			
		} catch (Exception $e) 
		{
			throw new Exception($e->getMessage(), $e->getCode());
		}
	}

}
?>












