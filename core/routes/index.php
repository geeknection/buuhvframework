<?php
/**
 * Controla as rotas do sistema
 */
final class Routes {
    function __construct() {}

    /**
     * Adiciona um novo parâmetro às rotas
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
     * Salva um novo parâmetro às rotas
     * @return void
     */
    private static function registerParam(Array $params, int $key, string $param, Array $uri_params)
    {
        preg_match('/\:.*/', $param, $matches, PREG_OFFSET_CAPTURE);
        if (count($matches) > 0)
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
     * Define uma nova rota
     * @return function|catch
     */
    public static function set(string $params = '', $callback)
    {
        try
        {
            $match = true;
            $uri = str_replace(DOMAIN, '', $_SERVER['REQUEST_URI']);
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
            }
        }
        catch(Exception $e)
        {
            throw $e;
        }
    }
    /**
     * Retorna o valor de um parâmetro da rota
     */
    public static function getParam(string $param)
    {
        $indexOf = findIndex($GLOBALS['config']['params'], 'param', $param);
        if ($indexOf >= 0) return $GLOBALS['config']['params'][$indexOf]['value'];
        return null;
    }
    /**
     * Chama a view
     */
    public static function get($view)
    {
        $file = PATH . '/app/views/' . $view . '/index.php';
        if (file_exists($file)) 
        {
            require_once($file);
        }
        else
        {
            $GLOBALS['config']['not_found'] = true;
        }
    }
    /**
     * Caso nenhuma rota seja encontrada carrega a página 404
     * @return void
     */
    public static function notFound()
    {
        if ($GLOBALS['config']['not_found'] === true)
        {
            $file = PATH . '/app/views/404/index.php';
            if (file_exists($file))
            {
                require_once($file);
            }
            else
            {
                throw new Exception("Page 404 is required. File not found.");
            }
        }
    }
}
?>