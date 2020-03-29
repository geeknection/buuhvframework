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
        $this->loadControlls();
        $this->loadModels();
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
    private function loadControlls() {
        try
        {
            $path   = PATH . '/app/controllers/*';
            $dirs    = array_filter(glob($path), 'is_dir');
            foreach ($dirs as $dir)
            {
                $file = $dir . '/index.php';
                if (file_exists($file)) require_once($file);
            }
        }
        catch(Exception $e)
        {
            echo $e->getMessage() . PHP_EOL;
        }
    }
    /**
     * Carrega as models da aplicação
     * @return void
     */
    private function loadModels() {
        try
        {
            $path   = PATH . '/app/models/*';
            $dirs    = array_filter(glob($path), 'is_dir');
            foreach ($dirs as $dir)
            {
                $file = $dir . '/index.php';
                if (file_exists($file)) require_once($file);
            }
        }
        catch(Exception $e)
        {
            echo $e->getMessage() . PHP_EOL;
        }
    }
}
new AutoloadCore();
?>