<?php
/**
 * Globals Variables - BuuhV Framework.
 * PHP Version 7.4.
 *
 * @see https://github.com/geeknection/buuhvframework The BuuhVFramework GitHub project
 *
 * @author    Bruno Nascimento (original founder)
 */

$prevConfig = array(
    'routes' => array(),
    'path' => __DIR__ . '/..',
    'params' => array(),
    'not_found' => true,
    'routeMatched' => false
);
/**
 * Load .config variables
 * @return array
 */
function config()
{
    global $prevConfig;

    $file = file($prevConfig['path'] . '/.config');
    $data = array();
    foreach($file as $line){
        $line = trim($line);
        $value = explode('\n', $line);
        foreach ( $value as $explode ) {
            $explode = explode("=", $explode);
            $data[$explode[0]] = $explode[1];
        }
    }

    return $data;
}
$config = config();
foreach ($prevConfig as $key => $value) {
    $config[$key] = $value;
}
$GLOBALS['config'] = $config;

define('PATH', $GLOBALS['config']['path']);
define('DOMAIN', $GLOBALS['config']['domain']);
?>