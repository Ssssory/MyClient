<?php

namespace App\Tool;

use App\AbstractClass\MyGuzzleAbstractClass;
use GuzzleHttp\Client;

class WGuzzleClass
{
    protected $client;
    protected $headers = ['Content-type' => "application/json"];
    protected $param;

    function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @param MyGuzzleAbstractClass $obApi
     * @return array
     */
    function push (MyGuzzleAbstractClass $obApi){

        $this->prepare($obApi);

        try {
            $response = $this->client->request($obApi->getMethod(), $obApi->url, $this->param);
            return  \GuzzleHttp\json_decode($response->getBody()->getContents(),true);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return ["Response"=>$e->getResponse(), "Message"=>$e->getMessage(), "Request"=>$e->getRequest()];
        }
    }

    public function prepare(MyGuzzleAbstractClass $obApi)
    {
        if (!empty($obApi->json)) {
            $this->param["json"] = $obApi->getJson();
        }
        if (!empty($obApi->headers)) {
            $this->param["headers"] = $obApi->headers;
        }else{
            $this->param["headers"] = $this->headers;
        }
    }
}