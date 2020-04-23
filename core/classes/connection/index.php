<?php
/**
 * Database Connecton - BuuhV Framework.
 * PHP Version 7.4.
 *
 * @see https://github.com/geeknection/buuhvframework The BuuhVFramework GitHub project
 *
 * @author    Bruno Nascimento (original founder)
 */

namespace BuuhV;

use Exception;
use PDO;
use PDOException;

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