<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);

//Middleware responsavel por fazer a autenticação do usuario
$app->add(new Tuupola\Middleware\JwtAuthentication([
    "header" => "Authorization",
    "regexp" => "/(.*)/",
    "path" => "/api", /* or ["/api", "/admin"] */
    "ignore" => ["/api/token"],
    "secret" => $container->get('settings')['secretKey']
]));

//envio de cabecalhos com os recursos da api
$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*') //define qual site pode acessar a api - * permite qualquer site
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');// quais os metodos q estão disponiveis na api
});
