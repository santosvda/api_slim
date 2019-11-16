<?php

//habilitando o CORS para que requisições ajax/js possam ser respondidas corretamente pela API

//rota options precisa ser criada para q outros site consigam enviar uma requisição do tipo options para saber quais recursos estão disponiveis dentro da api (middleware.php)
$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

// Routes
require __DIR__ . '/routes/autenticacao.php';

require __DIR__ . '/routes/produtos.php';

//metodo map vai tratar e exibir mensagens do slim para pagina não encontrada caso seja feita uma requisição para uma rota não utilizada/não exista

// Catch-all route to serve a 404 Not Found page if none of the routes match
// NOTE: make sure this route is defined last
$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function($req, $res) {
    $handler = $this->notFoundHandler; // handle using the default Slim page not found handler
    return $handler($req, $res);
});