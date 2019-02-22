<?php
namespace App\Tool;

use App\Tool\OzonMain;

class OzonApi extends OzonMain
{
    public $requestId;

    public $param = [];


    public function getCategoriesTree($categoryId = false){
        $this->clearJson();
        if($categoryId){
            $this->setUrl('/v1/categories/tree/'.$categoryId);
        }else{
            $this->setUrl('/v1/categories/tree');
        }
        $this->method = "GET";

        return $this->push();
    }
    
    public function getCategoriAttributes($categoryId){
        $this->clearJson();
        $this->setUrl('/v1/categories/'.$categoryId.'/attributes');
        $this->method = "GET";

        return $this->push();
	}

}