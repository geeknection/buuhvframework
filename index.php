<?php
/**
 * @author - Bruno Nascimento
 */
error_reporting(E_ALL);
session_start();
require(__DIR__ . '/core/autoload.php');
require(__DIR__ . '/app.php');
new App();