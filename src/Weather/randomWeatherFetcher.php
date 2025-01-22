<?php
declare(strict_types=1);
namespace App\Weather;

class randomWeatherFetcher implements WeatherInterface{

    public function fetch(string $city) : WeatherInfo{
        $weatherTypes = ['sunny', 'snowy', 'cloudy', 'stormy'];
        return new WeatherInfo($city,rand(250,350),$weatherTypes[rand(0,sizeof($weatherTypes)-1)]);
    }
}