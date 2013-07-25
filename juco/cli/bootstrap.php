<?php

// Composer autoloader
require __DIR__.'/../../vendor/autoload.php';

// Shortcut for DS
define('DS', DIRECTORY_SEPARATOR);

$database_settings = array(
	'driver'    => 'mysql',
	'host'      => '127.0.0.1',
	'database'  => 'database',
	'username'  => 'username',
	'password'  => 'password',
	'collation' => 'utf8_general_ci',
	'charset'   => 'utf8',
	'prefix'    => ''
);

$connFactory = new \Illuminate\Database\Connectors\ConnectionFactory(new \Illuminate\Container\Container);
$conn = $connFactory->make($database_settings);
$resolver = new \Illuminate\Database\ConnectionResolver();
$resolver->addConnection('default', $conn);
$resolver->setDefaultConnection('default');
\Illuminate\Database\Eloquent\Model::setConnectionResolver($resolver);