<?php

use App\Core\Router;

define('ROOT_DIR', realpath(dirname(__DIR__)));
define('CONF_DIR', realpath(dirname(__DIR__)) . '/config');
define('TEMPLATE_DIR', realpath(dirname(__DIR__)) . '/templates');

require_once (ROOT_DIR . '/vendor/autoload.php');

try {
    $router = new Router();
    $controller = $router->getRoutes();
    $controller->execute();
} catch (Throwable $e) {
    echo '<code>['. get_class($e).']: '.$e.'</code>';
}