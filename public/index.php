<?php

use Static\Core\Router;
use Static\Core\Kernel;

require 'vendor/autoload.php';

$router = new Router();

// Rutas públicas
$router->add('GET', '/',    Static\Public\HomeHandler::class);
$router->add('GET', '/about',    Static\Public\AboutHandler::class);

$kernel = new Kernel($router);
$kernel->run();
