<?php
namespace BuuhV;

use Exception;

/**
 * Classe utilizada para fazer requisições
 */
final class Request {
    function __construct() {}

    /**
     * Realiza uma requisição
     */
    private static function request(string $url, Array $data, Array $headers = array(), bool $post = false, bool $put = false) {
        try
        {
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_POST, $post);
            curl_setopt($curl, CURLOPT_PUT, $put);
            if ($post === true|| $put === true)
            {
                curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
            }
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            $response = curl_exec($curl);
            curl_close($curl);
            if ($response[0] !== '[' && $response[0] !== '{') {
                $response = substr($response, strpos($response, '('));
            }
            $response = json_decode(trim($response,'();'), true);
            return $response;
        }
        catch(Exception $e)
        {
            throw new Exception($e);
        }
    }
    /**
     * Realiza requisição do tipo post
     */
    public static function post(string $url, Array $data, Array $headers = array())
    {
        return self::request($url, $data, $headers, true);
    }
    /**
     * Realiza requisição do tipo put
     */
    public static function put(string $url, Array $data, Array $headers = array())
    {
        return self::request($url, $data, $headers, false, true);
    }
}
?>