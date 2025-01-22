<?php
namespace App\Weather;

class fakeWeatherFetcher implements WeatherInterface {
    public function fetch(string $city): WeatherInfo {
        return new WeatherInfo("dubai",15,'sunny');
    }
        
}
