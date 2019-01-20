<?php
/**
 * Created by PhpStorm.
 * User: object
 * Date: 19.01.19
 * Time: 18:02
 */

return [
    'name' => 'My Project Migrations',
    'migrations_namespace' => 'App\Migrations',
    'table_name' => 'doctrine_migration_versions',
    'column_name' => 'version',
    'column_length' => 255,
    'executed_at_column_name' => 'executed_at',
    'migrations_directory' => __DIR__ . '/src/Migrations',
    'all_or_nothing' => true,
];