<?php
require '../../vendor/autoload.php';

$container = new Pimple\Container();

$container[\App\ProductRepository::class] = function ($c) {
    return new \App\PdoProductRepository();
};

$service = new \App\ProductService($container[\App\ProductRepository::class]);

function getProducts(){
    global $service;
    return $service->getAll();
}

$options = [
    'uri' => 'http://127.0.0.1:8080/soap/server.php'
];
$soap = new SoapServer(NULL, $options);

$soap->addFunction('getProducts');
//$soap->setObject($service);

$soap->handle();

