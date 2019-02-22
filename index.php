<?php 
require 'vendor/autoload.php';
use App\Tool\OzonApi;

$WGuzzle = new OzonApi("dev");
echo "<pre>";
print_r($WGuzzle->getCategoriesTree());
echo "</pre>";
