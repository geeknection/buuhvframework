<?php
/**
 * JWT - BuuhV Framework.
 * PHP Version 7.4.
 *
 * @see https://github.com/geeknection/buuhvframework The BuuhVFramework GitHub project
 *
 * @author    Bruno Nascimento (original founder)
 */
namespace BuuhV;

use Exception;

class JWT {
    /**
     * Build Header
     * @return string
     */
    private static function buildHeader()
    {
        $header = [
            'type' => 'JWT',
            'alg' => 'HS256'
        ];
        $header = json_encode($header);
        $header = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));

        return $header;
    }
    /**
     * Build Content
     * @return string
     */
    private static function buildPayload(Array $data)
    {
        $payload = [
            'iss' => str_replace('https://', '', DOMAIN),
        ];
        if ( count($data) > 0 ) {
            foreach ($data as $key => $value) {
                $payload[$key] = $value;
            }
        }
        $payload = json_encode($payload);
        $payload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));

        return $payload;
    }
    /**
     * Build Credentials
     * @return string
     */
    private static function buildSignature(string $header, string $payload)
    {
        $prev_token = $header.'.'.$payload;
        $signature = hash_hmac('sha256', $prev_token, $GLOBALS['config']['app_key'], true);
        $signature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

        return $signature;
    }
   /**
    * New token
    * @return string
    */
    public static function register($data = array())
    {
        try
        {
            $header = self::buildHeader();
            $payload = self::buildPayload($data);
            
            $signature = self::buildSignature($header, $payload);

            $token = $header.'.'.$payload.'.'.$signature;

            return $token;
        }
        catch(Exception $e)
        {
            throw new Exception($e);
        }
    }
    /**
     * Token content
     * @return array
     */
    public static function data(string $jwt)
    {
        preg_match('/Bearer\s(\S+)/', $jwt, $matches);
        if (count($matches) > 1) $jwt = $matches[1];
        
        $explode    = explode(".", $jwt);
        $payload = json_decode(base64_decode($explode[1]), true);
                
        return $payload;
    }
    /**
     * Valid jwt
     * @return array
     */
    public static function valid(string $jwt = '') {
        try
        {
            preg_match('/Bearer\s(\S+)/', $jwt, $matches);
            if (empty($matches[1])) throw new Exception("Invalid access token");
            $jwt = $matches[1];
            
            $explode    = explode(".", $jwt);
            if (count($explode) !== 3) return array('status' => false, 'message' => 'invalid_access_token');

            $header     = $explode[0];
            $payload    = $explode[1];
            $signature  = $explode[2];


            $prev_signature = self::buildSignature($header, $payload);
            if ($prev_signature !== $signature)
            {
                return array(
                    'status' => false,
                    'message' => 'invalid_access_token'
                );
            }
            
            $jwtData = self::data($jwt);

            if (!empty($jwtData['expires']) && $jwtData['expires'] <= time())
            {
                return array(
                    'status' => false,
                    'message' => 'access_token_expired'
                );
            }
            return array(
                'status' => true
            );
        }
        catch(Exception $e)
        {
            throw new Exception($e);
        }
    }
}