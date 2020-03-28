<?php
/**
 * Controlador de autenticação
 */
use Session\Session;

class Auth extends Session {
    function __construct() {}

    /**
     * Realiza o login
     */
    public static function signIn(Array $params)
    {
        try
        {
            if (empty($params['user']))
            {
                throw new Exception("User is required");
            }
            if (empty($params['password']))
            {
                throw new Exception("Password is required");
            }
            
            self::set('user_id', 1);
        }
        catch(Exception $e)
        {
            throw new Exception($e->getMessage());
        }
    }
}