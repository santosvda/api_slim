<?php
// verificação apenas para garantir se a index.php esta rodando a partir de webserver
if (PHP_SAPI != 'cli') {
    exit('Rodar via CLI');
    //estou barrando que o db.php seja executado por um browser, sera apenas apena via linha de comando 
}

// __DIR__ constante magica utilizada para recuperar o caminho da pasta onde esta sendo executada
require __DIR__ . '/vendor/autoload.php';

// Instantiate the app
$settings = require __DIR__ . '/src/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
require __DIR__ . '/src/dependencies.php';

$db = $container->get('db');

$schema = $db->schema();
$tabela = 'produtos';

$schema->dropIfExists($tabela);

//cria a tabela produtos
$schema->create($tabela, function($table){

		$table->increments('id');
		$table->string('titulo', 100);
		$table->text('descricao');
		$table->decimal('preco', 11, 2);
		$table->string('fabricante', 60);
		$table->timestamps();

});

//Preenche Tabela
$db->table($tabela)->insert([
	'titulo' => 'Smartphone Motorola Moto G7 64Gb Dual Chip',
	'descricao' => 'Android Oreo - 8.0 tela 5.7" Octa-Core
		1.8Ghz 4G Câmera 12 + 5MP (dual traseira) - Índigo',
	'preco' => 1300.00,
	'fabricante' => 'Motorola',
	'created_at' => '2019-10-15',
	'updated_at' => '2020-01-01'
]);

$db->table($tabela)->insert([
	'titulo' => 'Iphone X Branco Espacial 128GB',
	'descricao' => 'Tela 5.8" IOS 13 4G Wi-Fi Câmera 12MP - Apple',
	'preco' => 4999.00,
	'fabricante' => 'Apple',
	'created_at' => '2019-10-15',
	'updated_at' => '2020-01-01'
]);