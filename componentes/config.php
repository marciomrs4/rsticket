<?php
/**
 * @example Funcao para carregar todas as classes model
 *
 */
session_start();

$_SESSION['projeto'] = 'rsticket';


$_SESSION['config']['usuario'] = 'Utilizador';
$_SESSION['config']['problema'] = 'Servi�o';
$_SESSION['config']['ramal'] = 'Extens�o';
$_SESSION['config']['senha'] = 'Palavra-passe';


/*
$_SESSION['config']['usuario'] = 'Usu�rio';
$_SESSION['config']['problema'] = 'Problema';
$_SESSION['config']['ramal'] = 'Ramal';
$_SESSION['config']['senha'] = 'Senha';
*/

$Projeto = 'rsticket';

include_once 'autoload.php';

date_default_timezone_set('America/Sao_Paulo');

?>