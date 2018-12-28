<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

$app = new \Slim\App;

$container = $app->getContainer();

$container['RedisPool'] = new RedisPool;

$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name </br>");
    return $response;
});

$app->get('/setredis', function(Request $request, Response $response, array $args) use ($container) {
    $container['RedisPool']->set("TestRedis","HelloWorld");
    $response->getBody()->write("Done");
    return $response;
});

$app->get('/getredis', function(Request $request, Response $response, array $args) use ($container) {
    $data = $container['RedisPool']->get("TestRedis");
    $response->getBody()->write($data);
    return $response;
});


$app->run();
