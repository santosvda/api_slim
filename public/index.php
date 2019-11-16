<?php
// verificação apenas para garantir se a index.php esta rodando a partir de webserver
if (PHP_SAPI == 'cli-server') {
	//PHP_SAPI retorna a interface q esta sendo utilizada para a execução do script php
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

// __DIR__ constante magica utilizada para recuperar o caminho da pasta onde esta sendo executada
require __DIR__ . '/../vendor/autoload.php';

session_start();//para trabalhar com sessões

// Instantiate the app
$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
require __DIR__ . '/../src/dependencies.php';

// Register middleware
require __DIR__ . '/../src/middleware.php';

// Register routes
$container->get('db'); // automaticamente de dependcias é iniciado o trecho de cod que conecta com o banco
require __DIR__ . '/../src/routes.php';

// Run app
$app->run();
