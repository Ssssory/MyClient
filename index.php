<?php 
require 'vendor/autoload.php';
use App\Tool\OzonApi;

$WGuzzle = new OzonApi();
echo "<pre>";
print_r($WGuzzle->getCategoriesTree());
echo "</pre>";
