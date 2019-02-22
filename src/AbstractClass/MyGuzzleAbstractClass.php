<?php
namespace App\AbstractClass;

use App\Interfaces\MainGuzzleInterface;

abstract class MyGuzzleAbstractClass implements MainGuzzleInterface
{
    // Для отправки запроса, нам минимально необходим метод передачи и адрес.
    // Данные в теле запроса передаются не всегда. Тело запроса отдаём массивом, Guzzle сам конвертирует
    // массив в json. Но ключ называется именно json. Так и храним его.


    /**
     * @var string
     */
    public $url;

    /**
     * @var string
     */
    public $method;

    /**
     * @var array
     */
    public $json;

    /**
     * @var array
     */
    public $headers;

    /**
     * @return string
     */
    public function getUrl (){
        return $this->url;
    }

    /**
     * @return string
     */
    abstract public function getMethod ();

    /**
     * @return array
     */
    abstract public function getJson ();

    /**
     * @return array
     */
    public function getHeaders (){
        return $this->headers;
    }
}