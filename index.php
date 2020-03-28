<?php
/**
 * @author - Bruno Nascimento
 */
error_reporting(0);
session_start();
require(__DIR__ . '/core/autoload.php');
require(__DIR__ . '/app.php');
new App();