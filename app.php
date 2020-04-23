<?php
/**
 * BuuhV Framework.
 * PHP Version 7.4.
 *
 * @see https://github.com/geeknection/buuhvframework The BuuhVFramework GitHub project
 *
 * @author    Bruno Nascimento (original founder)
 */

final class App {

    function __construct()
    {
        $this->init();
    }

    /**
     * Start application
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
     * Return layout file path
     * @return string
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