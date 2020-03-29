<?php
namespace BuuhVJWT;

use Exception;

/**
 * Sistema de token
 * @author - Bruno Nascimento
 */
class JWT {
    /**
     * Contrói o cabeçalho do jwt
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
     * Constrói os dados que serão inseridos no jwt para serem usados posteriormente
     * @return string
     */
    private static function buildPayload(Array $data)
    {
        $payload = [
            'iss' => preg_replace('/(http(s)://)?(.*\.)?/', '', DOMAIN),
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
     * Constrói a assinatura do jwt
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
    * Registra o jwt
    * @return array
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
     * Retorna os dados contídos no jwt
     * @return array
     */
    public static function data(string $payload)
    {
        $payload = json_decode(base64_decode($payload), true);
        unset($payload['iss']);
        
        return $payload;
    }
    /**
     * Valida o jwt
     * @return array
     */
    public static function valid(string $jwt = '') {
        try
        {
            $explode    = explode(".", $jwt);
            if (count($explode) < 3) return array('status' => false, 'message' => 'invalid_access_token');

            $header     = $explode[0];
            $payload    = $explode[1];
            $signature  = $explode[2];


            $prev_signature = self::buildSignature($header, $payload);
           
            if ($prev_signature !== $signature)
            {
                return array(
                    'status' => false,
                    'message' => 'access_token_expired'
                );
            }
            
            $jwtData = self::data($payload);
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