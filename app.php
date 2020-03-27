<?php
/**
 * Renderiza as páginas da aplicação e inicia o framework
 * @author - Bruno Nascimento
 */
class App {

    function __construct()
    {
        $this->init();
    }

    /**
     * Inicia a classe App
     */
    public function init()
    {
        try
        {
            require(PATH . '/app/autoload.php');
            require(PATH . '/app/index.php');
        }
        catch (Exception $e)
        {
            echo $e;
        }
    }
}
new App();
?>