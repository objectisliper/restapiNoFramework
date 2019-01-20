<?php
/**
 * Created by PhpStorm.
 * User: object
 * Date: 12.01.19
 * Time: 14:43
 */

declare(strict_types = 1);

namespace App;

require __DIR__ . '/../vendor/autoload.php';

error_reporting(E_ALL);

$environment = 'dev';

/**
 * Register the error handler
 */
$whoops = new \Whoops\Run;
if ($environment !== 'production') {
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
} else {
    $whoops->pushHandler(function($e){
        echo 'Something went wrong';
    });
}
$whoops->register();

$injector = include('Dependencies.php');

$request = $injector->make('Http\HttpRequest');
$response = $injector->make('Http\HttpResponse');

foreach ($response->getHeaders() as $header) {
    header($header, false);
}

$routeDefinitionCallback = function (\FastRoute\RouteCollector $r) {
    $routes = include('Routes.php');
    foreach ($routes as $route) {
        $r->addRoute($route[0], $route[1], $route[2]);
    }
};

$dispatcher = \FastRoute\simpleDispatcher($routeDefinitionCallback);

//Doctrine

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;

$paths = array(__DIR__ . '/src/Models');;
$isDevMode = true;

$dbParams = include '../config/db.php';

$config = Setup::createConfiguration($isDevMode);
$driver = new AnnotationDriver(new AnnotationReader(), $paths);
$loader = require __DIR__.'/../vendor/autoload.php';
AnnotationRegistry::registerLoader(array($loader, 'loadClass'));
$config->setMetadataDriverImpl($driver);

$entityManager = EntityManager::create($dbParams, $config);

if (isset($_SERVER['REQUEST_METHOD'])){
    $routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getPath());
    switch ($routeInfo[0]) {
        case \FastRoute\Dispatcher::NOT_FOUND:
            $response->setContent('404 - Page not found');
            $response->setStatusCode(404);
            break;
        case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
            $response->setContent('405 - Method not allowed');
            $response->setStatusCode(405);
            break;
        case \FastRoute\Dispatcher::FOUND:
            $className = $routeInfo[1][0];
            $method = $routeInfo[1][1];
            $vars = ['attr' => $routeInfo[2], 'em' => $entityManager];

            $class = $injector->make($className);
            $class->$method($vars);
            break;
}

    echo $response->getContent();
}



