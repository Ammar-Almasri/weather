<?php

namespace App\Weather;

interface WeatherInterface{
    public function fetch(string $city):WeatherInfo;
}