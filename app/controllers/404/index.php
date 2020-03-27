<?php
namespace NotFoundController;
/**
 * Controla a tela 404
 * @author - Bruno Nascimento
 */
class NotFoundController {
    function __construct() {}
    
    /**
     * Carrega as informações do Head
     */
    public static function head()
    {
        $style = file_get_contents(PATH . '/design/stylesheet/not-found.css');
        echo '<style>' . $style . '</style>';
    }
}