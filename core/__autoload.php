<?php
require(__DIR__ . '/utils/index.php');
require(__DIR__ . '/config.php');
/**
 * Arquivo que carrega as dependências do framework
 * @author - Bruno Nascimento
 */
final class AutoloadCore {
    public function __construct() {
        spl_autoload_register(array($this, 'load'));
        spl_autoload_register(array($this, 'loadControlls'));
        spl_autoload_register(array($this, 'loadModels'));
    }
    /**
     * Carrega as classes do framework
     * @return void
     */
    private function load($className) {
        $file = __DIR__ . '/classes/' . mb_strtolower($className) . '/index.php';
        if (file_exists($file)) require_once($file);
    }
    /**
     * Carrega os controladores da aplicação
     * @return void
     */
    private function loadControlls($className) {
        $file = PATH . '/app/controllers/' . mb_strtolower($className) . '/index.php';
        if (file_exists($file)) require_once($file);
    }
    /**
     * Carrega as models da aplicação
     * @return void
     */
    private function loadModels($className) {
        $file = PATH . '/app/models/' . mb_strtolower($className) . '/index.php';
        if (file_exists($file)) require_once($file);
    }
}
new AutoloadCore();
?>