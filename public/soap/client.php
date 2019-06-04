<?php

$options = [
    'location' => 'http://127.0.0.1:8000/soap/server.php',
    'uri' => 'http://127.0.0.1:8000/soap/server.php',
    'trace' => true,
    'compression'   => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | SOAP_COMPRESSION_DEFLATE,
];

$client = new SoapClient(NULL, $options);

try{
    $products = $client->__soapCall('getProducts', []);
    echo '<pre>';
    var_dump($products);
}
catch (SoapFault $fault){
     echo $fault->getMessage();
}