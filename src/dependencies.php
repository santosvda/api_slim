<?php
// DIC configuration
use Illuminate\Database\Capsule\Manager as Capsule;

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// db
$container['db'] = function($c){ //$c = container q é praticamente o array q ta em settings
	$capsule = new Capsule;
	$capsule->addConnection( $c->get('settings')['db'] );

	// Make this Capsule instance available globally via static methods... (optional)
	$capsule->setAsGlobal();
	// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
	$capsule->bootEloquent();

	return $capsule;
};