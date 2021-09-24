<?php  

namespace app\controllers;

require_once __DIR__.'/../vendor/autoload.php';

use app\Router;
use app\controllers\ProductController;
$router = new Router();
$a = new ProductController;
 
$router->get('/', [$a, 'index']);
$router->get('/products', [$a, 'index']);
$router->get('/products/create', [$a, 'create']);
$router->post('/products/create', [$a, 'create']);
$router->get('/products/update', [$a, 'update']);
$router->post('/products/update', [$a, 'update']);
$router->post('/products/delete', [$a, 'delete']);
// $router->get('/products/delete', [$a, 'delete']);

$router->resolve(); 