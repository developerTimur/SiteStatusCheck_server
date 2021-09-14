<?php

include "vendor/autoload.php";

use GuzzleHttp\Client;

if(isset($_GET['url'])){
    try{
        $client = new Client([ 'read_timeout' => 5, 'timeout'  => 5,'allow_redirects' => false,'http_errors' => true]);
        $response = $client->get($_GET['url']);
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

