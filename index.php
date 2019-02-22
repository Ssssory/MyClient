<?php 
require 'vendor/autoload.php';
use App\Tool\OzonApi;

$WGuzzle = new OzonApi();
echo "<pre>";
print_r($WGuzzle->getCategoriesTree(5621031));
echo "</pre>";
