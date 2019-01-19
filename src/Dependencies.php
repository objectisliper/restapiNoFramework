<?php
/**
 * Created by PhpStorm.
 * User: object
 * Date: 12.01.19
 * Time: 16:17
 */

declare(strict_types = 1);

$injector = new \Auryn\Injector;

$injector->alias('Http\Request', 'Http\HttpRequest');
$injector->share('Http\HttpRequest');
$injector->define('Http\HttpRequest', [
    ':get' => $_GET,
    ':post' => $_POST,
    ':cookies' => $_COOKIE,
    ':files' => $_FILES,
    ':server' => $_SERVER,
]);
$injector->delegate('Twig_Environment', function () use ($injector) {
    $loader = new Twig_Loader_Filesystem(dirname(__DIR__) . '/templates');
    $twig = new Twig_Environment($loader);
    return $twig;
});
$injector->alias('Http\Response', 'Http\HttpResponse');
$injector->alias('App\Template\Renderer', 'App\Template\TwigRenderer');
$injector->share('Http\HttpResponse');

return $injector;
