<?php
use App\Models\Produto;

// Rotas para produtos
/*
ORM -> Object Relational Mapper (Mapeador de objeto relacional) - Ferramente usada pra persisitr dados em um BD
Illuminate -> é o motos da base de dados Laravel sem o Laravel
Eloquent ORM - Perisistir dados
*/
$app->group('/api/v1', function(){

	$this->get('/produtos/lista', function($request, $response){

		$produtos = Produto::get();
		return $response->withJson($produtos);

	});

	// Adiciona um produto
	$this->post('/produtos/adiciona', function($request, $response){

		$dados = $request->getParsedBody();

		//validar

		$produto = Produto::create($dados);
		return $response->withJson($produto);

	});

	//recuperar produto para um determinado ID
	$this->get('/produtos/lista/{id}', function($request, $response, $args){

		$produto = Produto::findOrFail( $args['id'] );
		return $response->withJson($produto);

	});

	//Atualizar produto para um determinado ID
	$this->put('/produtos/atualiza/{id}', function($request, $response, $args){

		$dados = $request->getParsedBody();
		$produto = Produto::findOrFail( $args['id'] );
		$produto->update($dados);
		return $response->withJson($produto);

	});

	//remover produto para um determinado ID
	$this->get('/produtos/remove/{id}', function($request, $response, $args){
		//seria bacana ao inves de excluir somente desativar ou criar um id_cliente para que o cliente só consiga remover produtos add pelo mesmo
		$produto = Produto::findOrFail( $args['id'] );
		$produto->delete();
		return $response->withJson($produto);

	});
});