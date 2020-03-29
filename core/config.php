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
    'lang' => 'en-us',
    'app_key' => ''
);

define('PATH', $GLOBALS['config']['path']);
define('DOMAIN', $GLOBALS['config']['domain']);
?>