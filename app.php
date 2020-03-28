<?php
/**
 * Renderiza as páginas da aplicação e inicia o framework
 * @author - Bruno Nascimento
 */
final class App {

    function __construct()
    {
        $this->loadControllers();
        $this->init();
    }

    /**
     * Inicia a aplicação
     * @return void|string
     */
    public function init()
    {
        try
        {
            require(PATH . '/app/index.php');
        }
        catch (Exception $e)
        {
            echo $e->getMessage() . PHP_EOL;
        }
    }

    /**
     * Controladores da aplicação
     * @todo - Carregua todos os controladores da aplicação
     * @return void
     */
    public function loadControllers()
    {
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
     * Retorna o link de um arquivo de layout da aplicação
     */
    public static function layout(string $name = '')
    {
        if (empty($name)) return false;
        $file = PATH . '/layout' . $name;
        if (!file_exists($file)) return false;

        return str_replace(PATH, DOMAIN, $file);
    }
}
?>