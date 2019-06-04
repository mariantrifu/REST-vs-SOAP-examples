<?php

ini_set('default_socket_timeout', 120);
ini_set('user_agent','Firefox');

$options = [
    'location' => 'http://127.0.0.1:8080/soap/server.php',
    'uri' => 'urn://127.0.0.1:8080/soap/server.php',
    'trace' => true,
    'keep_alive' => false,
    'compression'   => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | SOAP_COMPRESSION_DEFLATE
];

$client = new SoapClient(NULL, $options);



try{
    $products = $client->__soapCall('getProducts', []);
}
catch (SoapFault $fault){
    var_dump($client->__getLastRequestHeaders());
    echo htmlentities($client->__getLastRequest());

    var_dump($client->__getLastResponseHeaders());
    var_dump($client->__getLastResponse());

    var_dump($fault->getMessage());
}

var_dump($products);