<?php

ini_set('user_agent','Firefox');

/**
 * Example with Guzlle
 */
require '../../vendor/autoload.php';

$client = new \GuzzleHttp\Client([
    'base_uri' => 'http://127.0.0.1:8000',
]);

try{
    $response = $client->request('POST','/rest/products/',[
        'form_params' => [
            'name' => 'motor BMW',
            'description' => '250cm, 6 viteze'
        ]
    ]);
}
catch ( \GuzzleHttp\Exception\GuzzleException $e){
    echo $e->getMessage();
}

echo $response->getStatusCode();

/**
 * Example with stream context
 */
$base_uri = 'http://localhost:8000/rest/';

$data = json_encode([
    'name' => 'motocicleta',
    'description' => 'kawa 500cm'
]);

// setup request context
$options = [
    'http' => [
        'method' => 'POST',
        'header' => [
            'Content-type: application/json'
        ],
        'content' => $data
    ]
];

$context = stream_context_create($options);

//make the request
$response = file_get_contents($base_uri.'products/', false, $context);

if(false === $response)
    die('Result can not be parsed');

$proudct = json_decode($response, true);