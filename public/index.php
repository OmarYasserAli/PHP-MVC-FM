<?php




/**
 * Front controller
 *
 * PHP version 5.4
 */


spl_autoload_register(function ($class) {
	

    $root = dirname(__DIR__);   // get the parent directory
    $file = $root . '/' . str_replace('\\', '/', $class) . '.php';
    if (is_readable($file)) {
        require $root . '/' . str_replace('\\', '/', $class) . '.php';
    }
});

// require '../Core/Router.php';

$router = new Core\Router();
$router->add("" ,["controller"=>"Home"]);
$router->add("postss" ,["controller"=>"postss", "action"=>"save"]);
// $router->add("admin/{controller}/{action}" );
$router->add("{controller}" );
$router->add("{controller}/{action}" );
$router->add("{controller}/{id:\d+}/{action}" );
$router->add("{controller}/{id:\d+}/{user}/{action}" );
$url =  $_SERVER['QUERY_STRING'];
// print_r ($router->getRoutes());

$router->dispatch($url);
// if ($router->match($url)) {
// 	var_dump($router->getParams());
// }
// else{
// 	print "Error 404 Not Found";
// }
// echo  get_class($router);
// echo 'Requested URL = "' . $_SERVER['QUERY_STRING'] . '"';
