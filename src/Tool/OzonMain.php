<?php
namespace App\Tool;

use App\AbstractClass\MyGuzzleAbstractClass;
use App\Tool\WGuzzleClass;

class OzonMain extends MyGuzzleAbstractClass
{
    /**
     * @var WGuzzleClass
     */
    private $guzzle;

    private $devSite     = "http://cb-api.test.ozon.ru";
    private $site        = "http://api-seller.ozon.ru";
    private $devClientId = 0;
    private $devApiKey   = '1';
	private $clientId    = 0;
	private $apiKey      = '1';

	public function __construct($env = "prod"){
        if( $env ==  "prod"){
            $this->headers = [
                'Client-Id' => $this->clientId,
                'Api-Key' => $this->apiKey,
                'Content-type' => "application/json"
            ];
            $this->currentSite = $this->site;
        }elseif ($env ==  "dev"){
            $this->headers = [
                'Client-Id' => $this->devClientId,
                'Api-Key' => $this->devApiKey,
                'Content-type' => "application/json"
            ];
            $this->currentSite = $this->devSite;
        }
        $this->guzzle = new WGuzzleClass();
    }
    
	public function getRequest($debug = false){
        if( $debug ){
            return [
                'headers' => $this->header,
                'method' => $this->method,
                'path' => $this->currentSite . $this->path,
                'json' =>$this->body,
                 'debug'    => true
            ];
        }else{
            return [
                'headers' => $this->header,
                'method' => $this->method,
                'path' => $this->currentSite . $this->path,
                'json' =>$this->body,
            ];
        }
    }
    
    public function setUrl($path)
    {
        $this->url = $this->currentSite . $path;
    }
    public function getJson()
    {
        return $this->json;
    }

    /**
     *  каждый запрос начинаем с очистки данных предыдущего запроса
     */
    public function clearJson()
    {
        $this->json = [];
        $this->param = [];
        $this->requestId = false;
        $this->method = false;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function push()
    {
        return $this->guzzle->push($this);
    }

}