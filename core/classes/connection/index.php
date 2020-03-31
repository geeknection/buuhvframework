<?php
/**
 * Classe que controla a conexão com o banco de dados
 */
final class Connection {
    public static $db;

    function __construct() {}

    /**
     * Abre uma conexão com o banco de dados
     */
    public static function start()
    {
        try
        {
            self::$db = new PDO(
                'mysql:host='. $GLOBALS['config']['host'] .';port='. $GLOBALS['config']['port'] .';dbname='. $GLOBALS['config']['name'],
                $GLOBALS['config']['user'], $GLOBALS['config']['password'],
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
            );

            return self::$db;
        }
        catch (PDOException $e)
        {
            throw new Exception($e);
        }
    }
    
    /**
     * Fecha a conexão
     */
    public static function close()
    {
        self::$db = null;
    }
}
?>