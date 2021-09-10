<?php

namespace App\Services;

use App\Configs\PachkaConfig;
use App\Configs\PachkaDiscussionConfig;
use Symfony\Component\HttpClient\HttpClient;

class PachkaAPI
{

    private $httpClient;
    private $apiServer = "https://api.pachca.com/api/shared/v1";
    private $accessToken = "";

    public function __construct()
    {
        $this->auth();
    }

    public function sendToPachka($message)
    {
        //"message": {
        //    "entity_type": "discussion",
        //    "entity_id": 198,
        //    "content": "Вчера мы продали 756 футболок (что на 10% больше, чем в прошлое воскресенье)"
        //  }
//        $response = $this->httpClient->request('POST', $this->apiServer."/messages", [
//            'json' => [ "message"=> [
//                "entity_type"=> "discussion",
//                "entity_id"=> PachkaDiscussionConfig::$id,
//                "content"=> $message
//                ]
//            ]
//        ]);

    }

    private function auth()
    {
        $this->httpClient = HttpClient::create();
//        $response = $this->httpClient->request('POST', $this->apiServer."/oauth/token", [
//            'json' => [
//                "client_id"=> PachkaConfig::$client_id,
//                "client_secret"=> PachkaConfig::$client_secret,
//                "grant_type"=> "authorization_code",
//                "code"=> PachkaConfig::$code,
//                "redirect_uri"=> PachkaConfig::$redirtect_url
//            ]
//        ]);

        $response = $this->httpClient->request('POST', $this->apiServer."/oauth/token", [
            'json' => [
                "client_id"=> PachkaConfig::$client_id,
                "client_secret"=> PachkaConfig::$client_secret,
                "grant_type"=> "refresh_token",
                "refresh_token"=> PachkaConfig::$refresh_code,
                "redirect_uri"=> PachkaConfig::$redirtect_url
            ]
        ]);
//var_dump($response->getContent());die();
        $decodedPayload = $response->toArray();
        var_dump($decodedPayload);
    }
}