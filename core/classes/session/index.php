<?php
/**
 * Session - BuuhV Framework.
 * PHP Version 7.4.
 *
 * @see https://github.com/geeknection/buuhvframework The BuuhVFramework GitHub project
 *
 * @author    Bruno Nascimento (original founder)
 */

namespace BuuhV;

use Exception;

class Session {
    function __construct() {}
    /**
     * Set new session
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
     * Get session values
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
     * Remove session
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