<?php
/**
 * BuuhV Framework.
 * PHP Version 7.4.
 *
 * @see https://github.com/geeknection/buuhvframework The BuuhVFramework GitHub project
 *
 * @author    Bruno Nascimento (original founder)
 */

error_reporting(E_ALL);
session_start();
require(__DIR__ . '/core/__autoload.php');
require(__DIR__ . '/app.php');
new App();