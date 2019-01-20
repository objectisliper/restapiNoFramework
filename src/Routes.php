<?php
/**
 * Created by PhpStorm.
 * User: object
 * Date: 12.01.19
 * Time: 15:08
 */

declare(strict_types = 1);

use App\Controllers\UsersApiController;

$routes = [
    ['GET', '/get_categories', ['App\Controllers\CategoriesApiController', 'getCategoriesList']],
    ['GET', '/get_products_in_category/{id}', ['App\Controllers\ProductsApiController', 'getProductsListByCategory']],
    ['POST', '/register_user', ['App\Controllers\UsersApiController', 'registerUser']],
    ['POST', '/login', ['App\Controllers\UsersApiController', 'login']],
    ['GET', '/get_products', ['App\Controllers\ProductsApiController', 'getProductsList']],
];

if (isset($_SERVER['HTTP_AUTHORIZATION']) && UsersApiController::isAuthGuard($_SERVER['HTTP_AUTHORIZATION'])) {
    $routes[] = ['POST', '/create_product', ['App\Controllers\ProductsApiController', 'createProduct']];
    $routes[] = ['DELETE', '/delete_product/{id}', ['App\Controllers\ProductsApiController', 'deleteProduct']];
    $routes[] = ['PUT', '/update_product/{id}', ['App\Controllers\ProductsApiController', 'updateProduct']];
    $routes[] = ['POST', '/create_category', ['App\Controllers\CategoriesApiController', 'createCategory']];
    $routes[] = ['DELETE', '/delete_category/{id}', ['App\Controllers\CategoriesApiController', 'deleteCategory']];
    $routes[] = ['PUT', '/update_category/{id}', ['App\Controllers\CategoriesApiController', 'updateCategory']];
}
return $routes;
