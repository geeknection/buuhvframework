<?php
namespace BuuhV;

use Exception;

/**
 * Controla o carregamento da view
 */
final class View {
    function __construct() {}

    /**
     * Substitui todas as variáveis do template pelos seus respectivos valores
     * @return string
     */
    private static function replaceParams(string $content, Array $variables)
    {
        $newContent = $content;
        if (count($variables) > 0) {
            foreach ($variables as $variable => $value) {
                $newContent = preg_replace('/{{' . $variable . '}}/', $value, $newContent);
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
        $file = PATH . '/app/views/pages/' . $view . '/index.html';
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
     * Carrega um componente
     * @todo - Utilize esse método quando quiser carregar componentes para uma view
     * @return string
     */
    public static function component(string $component, Array $params = array())
    {
        $html = '';
        $file = PATH . '/app/views/components/' . $component . '.html';
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
        $file = PATH . '/app/views/pages/404/index.html';
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