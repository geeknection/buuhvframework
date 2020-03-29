<?php
/**
 * Controla o carregamento da view
 */
final class View {
    function __construct() {}

    /**
     * Substitui todas as variáveis do template pelos seus respectivos valores
     * @return string
     */
    private static function replaceParams(string $content, Array $values)
    {
        $newContent = $content;
        if (count($values) > 0) {
            foreach ($values as $key => $value) {
                $newContent = preg_replace('/{{' . $key . '}}/', $value, $content);
            }
        }

        return $newContent;
    }
    /**
     * Carrega a view
     * @return void
     */
    public static function build(string $view, Array $params = array())
    {
        $file = PATH . '/app/views/' . $view . '/index.html';
        if (file_exists($file))
        {
            $html = file_get_contents($file);
            $html = self::replaceParams($html, $params);
            echo $html;
        }
        else
        {
            $GLOBALS['config']['not_found'] = true;
        }
    }
    /**
     * Carrega uma componente
     * @todo - Utilize esse método quando quiser carregar componentes para uma view
     * @return string
     */
    public static function getComponent(string $component, Array $params = array())
    {
        $html = '';
        $file = PATH . '/app/views/' . $component . '.html';
        if (file_exists($file))
        {
            $html = file_get_contents($file);
            $html = self::replaceParams($html, $params);
            return $html;
        }
        return $html;
    }
    /**
     * Carrega a página 404
     * @return void
     */
    public static function build404(Array $params = array())
    {
        $file = PATH . '/app/views/404/index.html';
        if (file_exists($file))
        {
            $html = file_get_contents($file);
            $html = self::replaceParams($html, $params);
            return $html;
        }
        else
        {
            throw new Exception("Page 404 is required. File not found.");
        }
    }
}