<?php
/**
 * View - BuuhV Framework.
 * PHP Version 7.4.
 *
 * @see https://github.com/geeknection/buuhvframework The BuuhVFramework GitHub project
 *
 * @author    Bruno Nascimento (original founder)
 */

namespace BuuhV;

use Exception;

final class View {
    function __construct() {}

    /**
     * Replace variables of html template for variables value
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
     * Load view
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
     * Load html template component
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
     * Load Not Found page
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