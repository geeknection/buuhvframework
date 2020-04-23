<?php
/**
 * Autload - BuuhV Framework.
 * PHP Version 7.4.
 *
 * @see https://github.com/geeknection/buuhvframework The BuuhVFramework GitHub project
 *
 * @author    Bruno Nascimento (original founder)
 */

require(__DIR__ . '/utils/index.php');
require(__DIR__ . '/config.php');
/**
 * File that loads the framework dependencies
 * @author - Bruno Nascimento
 */
final class AutoloadCore {
    public function __construct() {
        spl_autoload_register(array($this, 'load'));
        spl_autoload_register(array($this, 'loadControllers'));
        spl_autoload_register(array($this, 'loadModels'));
    }
    /**
     * Load the framework classes
     * @return void
     */
    private function load($className) {
        $className = explode('\\', $className);
        $file = __DIR__ . '/classes/' . mb_strtolower(end($className)) . '/index.php';
        if (file_exists($file)) require_once($file);
    }
    /**
     * Load application controllers
     * @return void
     */
    private function loadControllers($className) {
        $className = explode('\\', $className);
        $file = PATH . '/app/controllers/' . mb_strtolower(end($className)) . '/index.php';
        if (file_exists($file)) require_once($file);
    }
    /**
     * Load application models
     * @return void
     */
    private function loadModels($className) {
        $className = explode('\\', $className);
        $file = PATH . '/app/models/' . mb_strtolower(end($className)) . '/index.php';
        if (file_exists($file)) require_once($file);
    }
}
new AutoloadCore();
?>