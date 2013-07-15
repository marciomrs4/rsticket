<?php
include_once($_SERVER['DOCUMENT_ROOT']."/rsticket/componentes/config.php");

include($_SERVER['DOCUMENT_ROOT']."/{$Projeto}/componentes/script.php");

Texto::mostrarMensagem(Texto::erro($_SESSION['sempermissao']));

Texto::criarTitulo("Relatório");


Sessao::finalizarSessao();

include($_SERVER['DOCUMENT_ROOT']."/{$Projeto}/menurelatorio.php");
include($_SERVER['DOCUMENT_ROOT']."/{$Projeto}/componentes/rodape.php");

?>