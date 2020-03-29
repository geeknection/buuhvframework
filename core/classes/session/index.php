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
     * @return void
     */
    public static function set(string $name, $value, $expires = false)
    {
        if (empty($name)) throw new Exception('Name is empty');
        if (empty($value)) throw new Exception('Value is empty');
        $_SESSION[$name] = $value;
        if ($expires === false) setcookie($name, $value, time()+ (60*60*24*364));
    }
    /**
     * Pega valores de uma sessão
     * @return mixed
     */
    public static function get(string $name)
    {
        if (empty($name)) throw new Exception('Name is empty');
        
        if (!empty($_SESSION[$name])) return $_SESSION[$name];
        if (!empty($_COOKIE[$name])) return $_COOKIE[$name];

        return false;
    }
    /**
     * Remove uma sessão
     * @return void
     */
    public static function remove(string $name)
    {
        if (empty($name)) throw new Exception('Name is empty');
        if (!empty($_SESSION[$name])) unset($_SESSION[$name]);
        if (!empty($_COOKIE[$name])) setcookie($name, null, -1); 
    }
}
?>