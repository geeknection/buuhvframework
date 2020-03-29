<?php
namespace Session;

use Exception;

/**
 * Sistema de sessão
 * @todo - Em desenvolvimento
 */
class Session {
    function __construct() {}
    /**
     * Registra uma sessão
     */
    public static function set(string $name, $value, $expires = false)
    {
        if (empty($name)) throw new Exception('Name is empty');
        if (empty($value)) throw new Exception('Value is empty');
        if ($expires === false) setcookie($name, $value, time()+ (60*60*24*364));
        $_SESSION[$name] = $value;
    }
    /**
     * Pega valores de uma sessão
     */
    public static function get(string $name)
    {
        if (empty($name)) throw new Exception('Name is empty');
        
        if (!empty($_SESSION[$name]))
        {
            return $_SESSION[$name];
        }
        else if (!empty($_COOKIE[$name]))
        {
            return $_COOKIE[$name];
        }
        else
        {
            return false;
        }
    }
}
?>