<?php
/**
 * Controla o idioma da aplicação
 */
final class Lang {

    private static $lang = '';
    private static $texts = array();
    
    function __construct() {
        $this->identifyLang();
        $this->loadDictionary();
    }

    /**
     * Identifica o idioma do usuário
     */
    private static function identifyLang()
    {
        self::$lang = $GLOBALS['config']['lang'];
        if (empty($_SERVER['HTTP_ACCEPT_LANGUAGE']))
        {
            return false;
        }
        $lang = explode(';', $_SERVER['HTTP_ACCEPT_LANGUAGE'])[0];
        $lang = strtolower(explode(',', $lang)[0]);
        $file = PATH . '/texts/' . $lang . '.txt';
        if (file_exists($file))
        {
            self::$lang = $lang;
        }
    }
    /**
     * Carrega o arquivo de tradução
     * @return void
     */
    private static function loadDictionary()
    {
        $file = file(PATH . '/texts/' . self::$lang . '.txt');
        foreach($file as $line){
            $line = trim($line);
            $value = explode('\n', $line);
            foreach ( $value as $lang ) {
                $lang = explode("=", $lang);
                self::$texts[$lang[0]] = $lang[1];
            }
        }
    }
    /**
     * Retorna a tradução de um texto
     * @return string
     */
    public static function translate(string $key)
    {
        if (!empty(self::$texts[$key]))
        {
            return self::$texts[$key];
        }
        else
        {
            return $key;
        }
    }
}
new Lang();
?>