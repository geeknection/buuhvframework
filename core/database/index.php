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
    private const NAME = 'framework';
    private const USER = 'root';
    private const PASS = '';
    private const HOST = 'localhost';
    private const PORT = '3306';

    function __construct() {}

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