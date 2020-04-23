<?php
/**
 * Crons - BuuhV Framework.
 * PHP Version 7.4.
 *
 * @see https://github.com/geeknection/buuhvframework The BuuhVFramework GitHub project
 *
 * @author    Bruno Nascimento (original founder)
 */

namespace BuuhV;
class Crons {
    function __construct() {}

    /**
     * Read linux server cron file
     * @return array
     */
    public static function read() {
        $Jobs = shell_exec('crontab -l');
        $Jobs = explode("\n", $Jobs);
        array_pop($Jobs);
        return $Jobs;
    }
    /**
     * Rewrite linux server cron file
     * @return void
     */
    public static function set($Jobs) {
        $file = fopen('/tmp/php-crontab.tmp', 'w');
        for($i = 0; $i < count($Jobs); $i++) {
            fwrite($file, $Jobs[$i] . "\n");
        }

        fclose($file);
        shell_exec('crontab /tmp/php-crontab.tmp');
        unlink('/tmp/php-crontab.tmp');

    }
    /**
     * Add new cron to linux server
     * @return void
     */
    public static function add($Job) {
        $Jobs = self::read();
        if(self::check($Job)) return;
        array_push($Jobs, $Job);
        self::set($Jobs);
    }
    /**
     * Remove a cron from linux server
     * @return void
     */
    public static function remove($Job) {
        $Jobs = self::read();
        $UpdatedJobs = [];
        for($i = 0; $i < count($Jobs); $i++) {
        if(strpos($Jobs[$i], $Job) !== false) continue;
            array_push($UpdatedJobs, $Jobs[$i]);
        }
        self::set($UpdatedJobs);

    }
    /**
     * Check if cron exist in linux server
     * @return boolean
     */
    public static function check($Job) {
        $Jobs = self::read();

        for($i = 0; $i < count($Jobs); $i++) {
            if(strpos($Jobs[$i], $Job) !== false) return true;
        }

        return false;

    }
}
?>