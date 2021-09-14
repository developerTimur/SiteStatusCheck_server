<?php

include "vendor/autoload.php";

use GuzzleHttp\Client;

if(isset($_GET['url'])){
    try{
        $client = new Client([ 'timeout'  => 5.0,'allow_redirects' => false,'http_errors' => true]);
        $response = $client->get(urldecode($_GET['url']));
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([
            "status" => $response->getStatusCode(),
            "body" => $response->getBody()->getContents(),
        ]);
    }catch (Exception $e){
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([
            "status" => $e->getCode(),
            "body" => [
                $e->getMessage(),
                $e->getCode()
            ]
        ]);
    }
}

