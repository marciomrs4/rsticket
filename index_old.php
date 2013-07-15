<?php
include_once($_SERVER['DOCUMENT_ROOT']."/rsticket/componentes/config.php");

include($_SERVER['DOCUMENT_ROOT']."/{$Projeto}/componentes/script.php");

Texto::mostrarMensagem(Texto::erro($_SESSION['sempermissao']));

Texto::criarTitulo("RsTicket - Tecnologia da Informaчуo");

Texto::criarSubTitulo('Versуo Beta 1.0 - 24/03/2013');

Sessao::finalizarSessao();

//include($_SERVER['DOCUMENT_ROOT']."/{$Projeto}/menusecundario.php");
include($_SERVER['DOCUMENT_ROOT']."/{$Projeto}/componentes/rodape.php");

?>