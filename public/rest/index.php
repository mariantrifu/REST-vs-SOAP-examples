<?php

require '../../vendor/autoload.php';

$app = new \Slim\App;

$container = $app->getContainer();
$container[\App\ProductRepository::class] = function ($c) {
    return new \App\PdoProductRepository();
};
$service = new \App\ProductService($container[\App\ProductRepository::class]);

$app->get('/products/', function (\Slim\Http\Request $request, \Slim\Http\Response $response, array $args) use($service) {

    $products = $service->getAll();

    $response->getBody()->write(json_encode($products->getProducts(),JSON_FORCE_OBJECT));
    return $response;
});

$app->get('/product/{id}', function (\Slim\Http\Request $request, \Slim\Http\Response $response, array $args) use($service) {

    $product = $service->findById(new \App\ProductId($args['id']));

    $response->getBody()->write(json_encode($product,JSON_FORCE_OBJECT));
    return $response;
});

$app->post('/products/',function (\Slim\Http\Request $request, \Slim\Http\Response $response, array $args) use($service) {

    $product = $service->save(
        new \App\Product(
            new \App\ProductId($request->getParam('id')),
            $request->getParam('name'),
            $request->getParam('description')
        )
    );

    $response->withJson(json_encode($product,JSON_FORCE_OBJECT), 201);
    return $response;
});

$app->run();
