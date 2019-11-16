<?php
use App\Models\Produto;
use App\Models\Usuario;
use \Firebase\JWT\JWT;

/*
Site cliente (site, app, etc)

api.felipe
cadastro (email,senha)
token
*/
//Rotas para geração de tokken
$app->post('/api/token', function($request, $response){

	$dados = $request->getParsedBody();

	$email = $dados['email'] ?? null;
	$senha = $dados['senha'] ?? null;

	$usuario = Usuario::where('email', $email)->first();

	if(!is_null($usuario) && (md5($senha) === $usuario->senha) ){

		//gerar token
		$secretKey = $this->get('settings')['secretKey'];//define uma chave para criptografar e descriptografar o token

		$chaveAcesso = JWT::encode($usuario, $secretKey); //passa um array e o secretKey e o a biblioteca do firebase vai criar um token unico baseado nessas informações(se passar valor igual ele ai criar um token igual, mas só pelo id é praticamente impossivel fazer uma cagada dessas)

		return $response->withJson([
			'chave' => $chaveAcesso
		]);
	}

	return $response->withJson([
			'status' => 'erro'
		]);

});