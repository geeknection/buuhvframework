<?php
/**
 * Renderiza as páginas da aplicação e inicia o framework
 * @author - Bruno Nascimento
 */
final class App {

    function __construct()
    {
        $this->init();
    }

    /**
     * Inicia a aplicação
     * @return void|string
     */
    private function init()
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
     * Retorna o link de um arquivo de layout da aplicação
     */
    public static function layout(string $name = '')
    {
        if (empty($name)) return false;
        $file = PATH . '/app/views/layout' . $name;
        if (!file_exists($file)) return false;

        return str_replace(PATH, DOMAIN, $file);
    }
}
?>