<?php

namespace App\Interfaces;

/**
 * Interface MainGuzzleInterface
 * @package App\Interfaces
 * Интерфейс декларирует необходимый метод, для отправки запроса по api
 */
interface MainGuzzleInterface
{
    /**
     * @return array
     */
    public function getJson ();
}