<?php

namespace App\Cities;

interface citiesInterface{

    public function fetchCity(string $city):cityInfo;

}