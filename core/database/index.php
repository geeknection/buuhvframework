<?php
namespace BuuhVConn;

use Exception;
use PDO;
use PDOException;

/**
 * Classe que controla a conexão com o banco de dados
 */
final class Connection {
    public static $db;
    private const NAME = '';
    private const USER = '';
    private const PASS = '';
    private const HOST = '';
    private const PORT = '';

    function __construct() {
        $this->NAME = $GLOBALS['config']['name'];
        $this->USER = $GLOBALS['config']['user'];
        $this->PASS = $GLOBALS['config']['pass'];
        $this->HOST = $GLOBALS['config']['host'];
        $this->PORT = $GLOBALS['config']['port'];
    }

    /**
     * Abre uma conexão com o banco de dados
     */
    public static function start()
    {
        try
        {
            self::$db = new PDO(
                'mysql:host='. self::HOST .';port='. self::PORT .';dbname='. self::NAME,
                self::USER, self::PASS,
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