<?php

// Should be set to 0 in production
error_reporting(E_ALL);

// Should be set to '0' in production
ini_set('display_errors', env('DISPLAY_ERRORS'));

// Timezone
date_default_timezone_set(env('DATE_TIMEZONE'));

// Settings
$settings = [];

// Path settings
$settings['root'] = dirname(__DIR__);

// Error Handling Middleware settings
$settings['error'] = [

    // Should be set to false in production
    'display_error_details' => env('DEBUG'),

    // Parameter is passed to the default ErrorHandler
    // View in rendered output by enabling the "displayErrorDetails" setting.
    // For the console and unit tests we also disable it
    'log_errors' => env('DEBUG'),

    // Display error details in error log
    'log_error_details' => env('DEBUG'),
    
];

// Logger settings
$settings['logger'] = [
    'name' => 'app',
    'path' => __DIR__ . '/../logs',
    'filename' => 'app.log',
    'level' => \Monolog\Logger::DEBUG,
    'file_permission' => 0775,
];

// Database settings
$settings['db'] = [
    'driver' => env('DB_ADPT'),//mysql
    'host' => env('DB_HOST'),
    'database' => env('DB_NAME'),
    'username' => env('DB_USER'),
    'password' => env('DB_PASS'),
    'charset' => env('DB_CHAR'),
    'collation' => env('DB_COLL'),
    'prefix' => '',
    'options' => [
        // Turn off persistent connections
        PDO::ATTR_PERSISTENT => false,
        // Enable exceptions
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        // Emulate prepared statements
        PDO::ATTR_EMULATE_PREPARES => true,
        // Set default fetch mode to array
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        // Set character set
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci'
    ],
];

// Phoenix settings
$settings['phoenix'] = [
    'migration_dirs' => [
        'first' => __DIR__ . '/../database/migrations',
    ],
    'environments' => [
        'local' => [
            'adapter' => env('DB_ADPT'),
            'host' => env('DB_HOST'),
            'port' => env('DB_PORT'),
            'username' => env('DB_USER'),
            'password' => env('DB_PASS'),
            'db_name' => env('DB_NAME'),
            'charset' => env('DB_CHAR'),
        ],
        'local2' => [
            'adapter' => 'mysql',
            'host' => '127.0.0.1',
            'port' => 3306,
            'username' => 'root',
            'password' => 'root',
            'db_name' => 'slim_skeleton_diff',
            'charset' => 'utf8',
        ],
    ],
    'default_environment' => 'local',
    'log_table_name' => 'phoenix_log',
];

return $settings;