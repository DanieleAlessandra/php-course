<?php

use Bookstore\Core\Config;
use Bookstore\Core\Router;
use Bookstore\Core\Request;
use Bookstore\Models\BookModel;
use Bookstore\Utils\DependencyInjector;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once __DIR__ . '/vendor/autoload.php';

$config = new Config();

$dbConfig = $config->get('db_host');

$dsn = 'mysql:host=' . $dbConfig['host'] . ';port=' . $dbConfig['port'] . ';dbname=' . $dbConfig['name'];

//var_dump($dbConfig);die($dsn);

$db = new PDO(
	$dsn,
	$dbConfig['user'],
	$dbConfig['password']
);

$loader = new FilesystemLoader(__DIR__ . '/views');
$view = new Environment($loader);
var_dump($view->load());

$log = new Logger('bookstore');
$logFile = $config->get('log');
try {
	$log->pushHandler( new StreamHandler( $logFile, Logger::DEBUG ) );
} catch ( Exception $e ) {
}

$di = new DependencyInjector();
$di->set('PDO', $db);
$di->set('Utils\Config', $config);
$di->set('Twig\Environment', $view);
$di->set('Logger', $log);
$di->set('BookModel', new BookModel($di->get('PDO')));

$router = new Router($di);
$response = $router->route(new Request());
echo $response;
