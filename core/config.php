<?php
/**
 * Contém as variáveis globais do sistema
 * @author - Bruno Nascimento
 */
$GLOBALS['config'] = array(
    'routes' => array(),
    'path' => __DIR__ . '/..',
    'domain' => 'http://localhost',
    'params' => array(),
    'not_found' => true,
    'lang' => 'pt-br'
);

define('PATH', $GLOBALS['config']['path']);
define('DOMAIN', $GLOBALS['config']['domain']);
?>