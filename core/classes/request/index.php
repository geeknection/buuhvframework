<?php
/**
 * Requests - BuuhV Framework.
 * PHP Version 7.4.
 *
 * @see https://github.com/geeknection/buuhvframework The BuuhVFramework GitHub project
 *
 * @author    Bruno Nascimento (original founder)
 */

namespace BuuhV;

use Exception;

final class Request {
    function __construct() {}

    /**
     * Do request
     * @return array
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
     * Request type post
     * @return array
     */
    public static function post(string $url, Array $data, Array $headers = array())
    {
        return self::request($url, $data, $headers, true);
    }
    /**
     * Request type put
     * @return array
     */
    public static function put(string $url, Array $data, Array $headers = array())
    {
        return self::request($url, $data, $headers, false, true);
    }
}
?>