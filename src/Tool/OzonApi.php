<?php
namespace App\Tool;

use App\Tool\OzonMain;

class OzonApi extends OzonMain
{
    public $method = "POST";
    
    public $requestId;

    public $param = [];



    // public function getProductsExtended($rubricId, $page = 1, $perPage = 10)
    // {
    //     $this->clearJson();
    //     $this->setRequestId();
    //     $this->methodAPI = "getProductsExtended";
    //     $this->param = [
    //         "rubricId" => $rubricId,
    //         "page"     => $page,
    //         "perPage"  => $perPage,
    //     ];
    //     $this->json = [
    //         "jsonrpc"=>"2.0",
    //         "id"=>$this->getRequestId(),
    //         "method"=>$this->methodAPI,
    //         "params"=>$this->param
    //     ];

    //     return $this->push();

    // }

    public function getCategoriesTree($categoryId){
        $this->clearJson();        
        $this->path = '/v1/categories/tree/'.$categoryId;
        $this->json = [];

        return $this->push();
    }
    
    public function getCategoriAttributes($categoryId){
        $this->clearJson();
		$this->path = '/v1/categories/'.$categoryId.'/attributes';
        $this->json = [];

        return $this->push();
	}

}