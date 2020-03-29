<?php

use BuuhVJWT\JWT;

class Auth {
    function __construct() {}

    public static function register(Array $params)
    {
        $jwt = JWT::register(array(
            'email' => $params['email']
        ));

        return $jwt;
    }
    public static function login(Array $params)
{
        $jwt = '';
        if (preg_match('/Bearer\s(\S+)/', $params['Authorization'], $matches)) {
            $jwt = $matches[1];
        }
        
        $validJwt = JWT::valid($jwt);
        
        if ($validJwt['status'] === false) throw new Exception($validJwt['message']);

        $jwtData = JWT::data($jwt);
        return $jwtData;
    }
    
}