<?php
/**
 * Routes - BuuhV Framework.
 * PHP Version 7.4.
 *
 * @see https://github.com/geeknection/buuhvframework The BuuhVFramework GitHub project
 *
 * @author    Bruno Nascimento (original founder)
 */

namespace BuuhV;

use Exception;

final class Routes {
    function __construct() {}

    /**
     * Set routes param
     * @return void
     */
    public static function setParam(string $param, $value)
    {
        array_push($GLOBALS['config']['params'], array(
            'param' => $param,
            'value' => $value
        ));
    }
    /**
     * Register params of set method
     * @return void
     */
    private static function registerParam(Array $params, int $key, string $param, Array $uri_params)
    {
        preg_match('/\:.*/', $param, $matches, PREG_OFFSET_CAPTURE);
        if (count($matches) > 0 && !empty($uri_params[$key]))
        {
            array_push($GLOBALS['config']['params'], array(
                'param' => str_replace(':', '', $param),
                'value' => $uri_params[$key]
            ));
            $params[$key] = $uri_params[$key];
        }
        return $params[$key];
    }
    /**
     * Set new route
     * @return function|catch
     */
    public static function set(string $params = '', $callback)
    {
        try
        {
            if ($GLOBALS['config']['routeMatched'] === true) return false;
            $match = true;
            $uri = str_replace(DOMAIN, '', $_SERVER['REQUEST_URI']);
            $uri = explode('?', $uri)[0];
            $uri_params = explode('/', $uri);
            $params = explode('/', $params);
            if (count($uri_params) !== count($params)) return false;

            if (count($params) > 1) array_shift($params);
            if (count($uri_params) > 1) array_shift($uri_params);
            foreach ($params as $key => $param) {
                $result = self::registerParam($params, $key, $param, $uri_params);
                if ($result !== $uri_params[$key]) {
                    $match = false;
                    break;
                }
            }
            if ($match) {
                array_push($GLOBALS['config']['routes'], $uri);
                $GLOBALS['config']['not_found'] = false;
                $callback();
                $GLOBALS['config']['routeMatched'] = true;
            }
        }
        catch(Exception $e)
        {
            throw new Exception($e->getMessage());
        }
    }
    /**
     * Get routes param
     * @return mixed
     */
    public static function getParam(string $param)
    {
        $indexOf = findIndex($GLOBALS['config']['params'], 'param', $param);
        if ($indexOf >= 0) return $GLOBALS['config']['params'][$indexOf]['value'];
        return null;
    }
    /**
     * Load page 404 when not found route
     * @return void
     */
    public static function notFound(Array $params = array())
    {
        if ($GLOBALS['config']['not_found'] === true)
        {
            echo View::build404($params);
        }
    }
}
?>