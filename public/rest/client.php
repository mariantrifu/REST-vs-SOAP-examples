<?php

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

echo 'test';