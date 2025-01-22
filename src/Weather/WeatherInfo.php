<?php
namespace App\Weather;
class WeatherInfo{

    public function __construct(public string $city, public int $temp, public string $weatherType)
    {
        
    }
}