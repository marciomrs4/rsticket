<?php
/**
 * @example Funcao para carregar todas as classes model
 *
 */
session_start();

$_SESSION['projeto'] = 'rsticket';

$Projeto = 'rsticket';

include_once 'autoload.php';

date_default_timezone_set('America/Sao_Paulo');

?>