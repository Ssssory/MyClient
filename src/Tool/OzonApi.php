<?php
namespace App\Tool;

use App\Tool\OzonMain;

class OzonApi extends OzonMain
{
    public $requestId;

    public $param = [];

    ///////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////                           категории                                     //////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////

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

    ///////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////                           товар                                         //////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////

    public function getProductList($page = 1, $perPage = 1,$arrOfferId = [],$arProductId = [],$visibility = 'ALL'){
        $this->clearJson();
        $this->setUrl('/v1/product/list');
        $this->method = "POST";
        $this->json = [
            "filter" => [
                "offer_id" => $arrOfferId,
                "product_id" => $arProductId,
                "visibility" => $visibility
            ],
            'page' => $page,
            'page_size' => $perPage
        ];

        return $this->push();
    }
    public function getProductInfo($productId){
        $this->clearJson();
        $this->setUrl('/v1/products/info/'.$productId);
        $this->method = "GET";

        return $this->push();
    }
    public function getProductInfoSku($sku){
        $this->clearJson();
        $this->setUrl('/v1/product/info');
        $this->method = "POST";
        $this->json = [
            'sku' => (int)$sku
        ];

        return $this->push();
    }
    public function getProductInfoOfferId($offerId){
        $this->clearJson();
        $this->setUrl('/v1/product/info');
        $this->method = "POST";
        $this->json = [
            'offer_id' => $offerId
        ];

        return $this->push();
    }
    public function getProductInfoProductId($productId){
        $this->clearJson();
        $this->setUrl('/v1/product/info');
        $this->method = "POST";
        $this->json = [
            'product_id' => (int)$productId
        ];

        return $this->push();
    }
    // public function getProductInfo($prodId = false, $prodSku = false, $offerId = false){
    // 	$this->setUrl('/v1/products/info/');
    // 	$this->method = "POST";
    // 	$this->json = [
    // 		"product_id" => $prodId,
    // 		"sku" => $prodSku,
    // 		"offer_id" => $offerId,
    // 	];

    //     return $this->push();
    // }
    public function updateProductPrices($productId, $price, $oldPrice, $vat){
        $this->clearJson();
        $this->setUrl('/v1/products/prices');
        $this->method = "POST";
        $this->json = [
            'prices' => [
                [
                    'product_id' => (int)$productId,
                    'price' => (string)$price,
                    'old_price' => (string)$oldPrice,
                    'vat' => (string)$vat
                ]
            ]
        ];

        return $this->push();
    }
    public function updateProductPricesAr($arObj){
        $this->clearJson();
        $this->setUrl('/v1/products/prices');
        $this->method = "POST";
        $this->json = [
            'prices' => $arObj
        ];

        return $this->push();
    }
    public function updateProductStocks($product_id,$stock){
        $this->clearJson();
        $this->setUrl('/v1/products/stocks');
        $this->method = "POST";
        $this->json = [
            'stocks' => [
                [
                    'product_id' => (int)$product_id,
                    'stock' => (int)$stock
                ]
            ]
        ];

        return $this->push();
    }
    public function updateProductStocksAr($arObj){
        $this->clearJson();
        $this->setUrl('/v1/products/stocks');
        $this->method = "POST";
        $this->json = [
            'stocks' => $arObj
        ];

        return $this->push();
    }
    public function createProduct($arr){
        $this->clearJson();
        $this->setUrl('/v1/products/create');
        $this->method = "POST";
        $this->json = $arr;        
        
        return $this->push();
    }
    public function activateProduct($productId){
        $this->clearJson();
        $this->method = "POST";
        $this->setUrl('/v1/products/activate');
        $this->json = [
            'product_id' => (int)$productId
        ];

        return $this->push();
    }
    public function deactivateProduct($productId){
        $this->clearJson();
        $this->method = "POST";
        $this->setUrl('/v1/products/deactivate');
        $this->json = [
            'product_id' => (int)$productId
        ];

        return $this->push();
    }
    public function getProductParamMap()
    {
        $arMust = [
            "category_id"    => "",
            "name"           => "",
            "price"          => "",
            "vat"            => "",
            "vendor"         => "",
            "attributes"     => [],
            "images"         => [],
            "height"         => "",
            "depth"          => "",
            "width"          => "",
            "dimension_unit" => "",
            "weight"         => "",
            "weight_unit"    => "",

        ];
        $arOption = [
            "barcode"         => "",
            "description"     => "",
            "offer_id"        => "",
            "old_price"       => "",
            "vendor_code"     => "",
        ];
        $arImage = [
            "file_name"      => "",
            "default"        => "",
        ];
        $arAttributes = [
            "id"             => "",
            "value"          => "",
            "collection"     => [],
            "complex_collection"   => [],
        ];
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////                           заказы                                        //////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////

    public function getCancel(){
        $this->clearJson();
        $this->setUrl('/v1/cancel-reasons');
        // $this->setUrl('/v1/order/cancel-reason/list'); //19 02 19
        $this->method = "GET";

        return $this->push();
    }
    public function getProviders(){
        $this->clearJson();
        $this->setUrl('/v1/shipping-providers');
        $this->method = "GET";

        return $this->push();
    }
    public function getCrossborder($start,$end){
        $this->clearJson();
        $this->setUrl('/v1/orders/list/crossborder');
        $this->json = [
            'since' => $start,
            'to' => $end
        ];
        $this->method = "POST";

        return $this->push();
    }
    public function getFBS($start,$end){
        $this->clearJson();
        $this->setUrl('/v1/orders/list/fbs');
        $this->json = [
            'since' => $start,
            'to' => $end
        ];
        $this->method = "POST";

        return $this->push();
    }
    public function getFBO($start,$end){
        $this->clearJson();
        $this->setUrl('/v1/orders/list/fbo');
        $this->json = [
            'since' => $start,
            'to' => $end
        ];
        $this->method = "POST";

        return $this->push();
    }
    public function getOrder($orderId){
        $this->clearJson();
        $this->setUrl('/v1/order/'.$orderId);
        $this->json = [
            'order_id' => $orderId
        ];
        $this->method = "GET";

        return $this->push();
    }
    public function getCrossborderOrder($orderNumber){
        $this->clearJson();
        $this->setUrl('/v1/order/crossborder/'.$orderNumber);
        $this->json = [
            'order_number' => $orderNumber
        ];
        $this->method = "GET";

        return $this->push();
    }
    public function approveOrderItems($orderId, $arImemsId){
        $this->clearJson();
        $this->setUrl('/v1/order/items/approve/crossborder');
        $this->method = "POST";
        $this->json = [
            'order_id' => $orderId,
            'item_ids' => $arImemsId
        ];
        $this->method = "POST";

        return $this->push();
    }
    public function getUnfulfilled($page = 1, $perPage = 10){
        $this->clearJson();
        $this->setUrl('/v1/order/unfulfilled');
        $this->json = [
            'page' => $page,
            'page_size' => $perPage
        ];
        $this->method = "POST";

        return $this->push();
    }
    public function getCanceled($page = 1, $perPage = 10){
        $this->clearJson();
        $this->setUrl('/v1/order/canceled');
        $this->json = [
            'page' => $page,
            'page_size' => $perPage
        ];
        $this->method = "POST";

        return $this->push();
    }
    public function cancelItems($orderId, $reasonCode, $arImemsId){
        $this->clearJson();
        $this->setUrl('/v1/order/items/cancel/crossborder');
        $this->method = "POST";
        $this->json = [
            'order_id' => (int)$orderId,
            'reason_code' => (int)$reasonCode,
            'item_ids' => (array)$arImemsId
        ];
        $this->method = "POST";

        return $this->push();
    }
    public function ship($orderId, $trakingNumber, $shipingProviderId, $items){
        $this->clearJson();
        $this->setUrl('/v1/order/ship');
        // 	$this->setUrl('/v1/order/ship/crossborder'); //19 02 19
        $this->method = "POST";
        $this->json = [
            "order_id" => $orderId,
            'tracking_number' => $trakingNumber,
            "shipping_provider_id" => $shipingProviderId,
            'items' => $items
        ];
        $this->method = "POST";

        return $this->push();
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////                           чат                                           //////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////

    public function chatList($chatId, $page = 1, $perPage = 100 ){
        $this->clearJson();
        $this->setUrl('/v1/chat/list');
        // $this->method = "GET";
        if (!$chatId) {
            $this->json = [
                "page" => $page,
                "page_size" => $perPage
            ];
        }else{
            $this->json = [
                "chat_id_list" => array($chatId),
                "page" => $page,
                "page_size" => $perPage
            ];
        }
        $this->method = "POST";

        return $this->push();
    }
    public function chatStart($orderId){
        $this->clearJson();
        $this->setUrl('/v1/chat/start');
        $this->json = [
            'order_id' => $orderId
        ];
        $this->method = "POST";

        return $this->push();
    }
    public function chatHistory($chatId){
        $this->clearJson();
        $this->setUrl('/v1/chat/history');
        $this->json = [
            "chat_id" => $chatId
        ];
        $this->method = "POST";

        return $this->push();
    }
    public function chatSendMessage($chatId, $message){
        $this->clearJson();
        $this->setUrl('/v1/chat/send/message');
        $this->json = [
            "chat_id" => $chatId,
            "text" => $message
        ];
        $this->method = "POST";

        return $this->push();
    }
    public function chatSendFile($chatId, $fileName, $base64){
        $this->clearJson();
        $this->setUrl('/v1/chat/send/file');
        $this->json = [
            "base64_content" => $base64,
            "chat_id" => $chatId,
            "name" => $fileName
        ];
        $this->method = "POST";

        return $this->push();
    }
}