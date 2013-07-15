<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/rsticket/componentes/config.php');

if($_POST)
{
	if ($_SESSION['validacaoform'] == base64_encode(date('d-m-Y')))
	{


		$acao = base64_decode($_SESSION['acaoform']);

		switch ($acao)
		{
			case 'cadastrar/projeto' :

				$cadastro = new Cadastro();

				try
				{
					$cadastro->setDados($_POST);

					$cadastro->cadastrarProjeto();

					$cadastro->finalizarApp('cadastrar/projeto');

				}catch (Exception $e)
				{
					ClasseException::throwException($e,$_POST,'cadastrar/projeto');
				}
				break;

			case 'alterar/projeto' :
				$alteracao = new Alteracao();

				try
				{

					$alteracao->setDados($_POST);

					$alteracao->alterarProjeto();

					$alteracao->finalizarApp();

				}catch (Exception $e)
				{
					ClasseException::throwException($e);
				}
				break;
					
			case 'projeto/aprovar':
				$alteracao = new Alteracao();

				try
				{
					$alteracao->setDados($_POST);

					$alteracao->aprovarProjeto();

					$alteracao->finalizarApp();

				}catch (Exception $e)
				{
					ClasseException::throwException($e);
				}
				break;

			default:
				Sessao::destroiSessao();
				break;
					
		}

	}else
	{
		Sessao::destroiSessao();
	}
}else
{
	Sessao::destroiSessao();
}


?>
