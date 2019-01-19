<?php
/**
 * Created by PhpStorm.
 * User: object
 * Date: 12.01.19
 * Time: 15:08
 */

declare(strict_types = 1);


return [
    ['GET', '/', ['App\Controllers\Homepage', 'show']],
    ['GET', '/login', ['App\Controllers\Auth', 'loginPage']],
    ['POST', '/login', ['App\Controllers\Auth', 'login']],
    ['GET', '/logout', ['App\Controllers\Auth', 'logout']],
    ['GET', '/create_task', ['App\Controllers\TaskController', 'index']],
    ['POST', '/create_task', ['App\Controllers\TaskController', 'index']],
    ['GET', '/edit_task/{id}', ['App\Controllers\TaskController', 'editTask']],
    ['POST', '/edit_task/{id}', ['App\Controllers\TaskController', 'editTask']],
    ['PUT', '/complete_task/{id}', ['App\Controllers\TaskController', 'editTask']],
];
