<?php

namespace SigninController;
/**
 * Controla a tela de login
 * @author - Bruno Nascimento
 */
class SigninController {
    function __construct() {}
    
    /**
     * Carrega as informações do Head
     */
    public static function head()
    {
        $style = file_get_contents(PATH . '/design/stylesheet/signin.css');
        echo '<style>' . $style . '</style>';
    }
}