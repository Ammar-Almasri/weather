<?php
declare(strict_types=1);
namespace App\Cities;
use App\Cities\cityInfo;

class cityFetcher implements citiesInterface{
    public function fetchCity(string $city): cityInfo
    {


        $cities = [
            'Amman' => [31.95, 35.91],
            'New York' => [40.7128, -74.0060],
            'London' => [51.5074, -0.1278],
            'Tokyo' => [35.6895, 139.6917],
            'Paris' => [48.8566, 2.3522],
            'Berlin' => [52.5200, 13.4050],
            'Dubai' => [25.276987, 55.296249],
            'Sydney' => [-33.8688, 151.2093],
            'Moscow' => [55.7558, 37.6173],
            'Cairo' => [30.0444, 31.2357]
        ];
        $finalcity = null;
        if(isset($cities[$city])) $finalcity = $cities[$city];
        if($finalcity == null) $finalcity = $cities['Amman'];
        return new cityInfo($finalcity[0],$finalcity[1]);
    }
}