<?php
require '../../vendor/autoload.php';

$container = new Pimple\Container();

$container[\App\ProductRepository::class] = function ($c) {
    return new \App\PdoProductRepository();
};

$service = new \App\ProductService($container[\App\ProductRepository::class]);

function getProducts(){
    global $service;

    $products = $service->getAll();

    $p = [];
    foreach ($products->getProducts() as $product)
        $p[] = $product->jsonSerialize();

    return $p;
}

$options = [
    'uri' => 'http://127.0.0.1:8000/soap/server.php',
    'soap_version' => SOAP_1_2
];
$soap = new SoapServer(NULL, $options);

$soap->addFunction('getProducts');

$soap->handle();