<?php
/**
 * API - BuuhV Framework.
 * PHP Version 7.4.
 *
 * @see https://github.com/geeknection/buuhvframework The BuuhVFramework GitHub project
 *
 * @author    Bruno Nascimento (original founder)
 */

@ini_set("memory_limit", "-1");
@set_time_limit(0);
date_default_timezone_set('UTC');
session_start();
require_once(__DIR__ . '/app/tables.php');
require(__DIR__ . '/core/__autoload.php');
require_once(__DIR__ . '/app.php');

$allowedOrigins = array('(http(s)://)?(.*\.)?localhost', DOMAIN);
$origin = NULL;

if (array_key_exists('HTTP_ORIGIN', $_SERVER)) {
    $origin = $_SERVER['HTTP_ORIGIN'];
} else if (array_key_exists('HTTP_REFERER', $_SERVER)) {
    $origin = $_SERVER['HTTP_REFERER'];
} else if (array_key_exists('REMOTE_ADDR', $_SERVER)) {
    $origin = $_SERVER['REMOTE_ADDR'];
}

if ($origin) {
    foreach ($allowedOrigins as $allowedOrigin) {
        if (preg_match('#' . $allowedOrigin . '#', $origin)) {
            header('Access-Control-Allow-Origin: ' . $origin);
            header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
            header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With, Cache-Control, Pragma, Expires, Sec-Fetch-Mode, authorization');
            header('Access-Control-Allow-Credentials: true');
            break;
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
      echo json_encode(array('status' => 200));
      exit;
    }
}

$class = '';
$method = '';
if (isset($_GET['c'])) $class = $_GET['c'];
if (isset($_GET['m'])) $method = $_GET['m'];
$auth = '';
try {
    $input    = json_decode(file_get_contents("php://input"), TRUE);
    $request  = array_merge($_REQUEST, (array) $input);
    $headers  = getallheaders();
    $request  = array_merge($headers, $request);
    if (isset($request['authorization'])) $auth = $request['authorization'];
    if (isset($request['Authorization'])) $auth = $request['Authorization'];
    $request['Authorization'] = $auth;

    if (isset($_FILES)) $request  = array_merge($_FILES, $request);

    $class = ucfirst($class);
    if (class_exists($class))
    {
        if (method_exists($class, $method))
        {
            $response = NULL;
            $methodInfo = new ReflectionMethod($class, $method);
            if ($methodInfo->isStatic())
            {
                $response = call_user_func(array($class, $method), $request);
            } else {
                $response = call_user_func(array(new $class($request), $method), $request);
            }
            header("Content-type: application/json");
            echo json_encode(array(
                'status' => 200,
                'values' => $response
            ), JSON_PRETTY_PRINT);
            exit();
        }
        else
        {
            throw new Exception("Method doesnt exist");
        }
    }
    else
    {
        header("Content-type: application/json");
        echo json_encode(array(
            'status' => 400,
            'message' => 'Request failed'
        ), JSON_PRETTY_PRINT);
        exit();
    }
}
catch(Exception $e) {
    header("Content-type: application/json");
    echo json_encode(array(
        'status' => 500,
        'message' => $e->getMessage()
    ), JSON_PRETTY_PRINT);
    exit();
}
?>