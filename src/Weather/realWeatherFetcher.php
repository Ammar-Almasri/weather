<?php
declare(strict_types=1);
namespace App\Weather;

use App\Cities\cityFetcher;


class realWeatherFetcher implements WeatherInterface {
    public function fetch(string $city): WeatherInfo {
        $weatherTypes = [
            0 => 'Clear',
            1 => 'Clear', 
            2 => 'Cloudy', 
            3 => 'Cloudy', 
            45 => 'Fog', 
            51 => 'Drizzle', 
            53 => 'Drizzle', 
            55 => 'Drizzle', 
            61 => 'Showers', 
            63 => 'Showers', 
            65 => 'Showers', 
            66 => 'Snowy', 
            67 => 'Snowy', 
            71 => 'Snowy', 
            73 => 'Snowy', 
            75 => 'Snowy', 
            80 => 'Thunderstorms', 
            81 => 'Thunderstorms', 
            82 => 'Thunderstorms'
        ];
        $get = $_GET['city'];
        if(isset($_GET['city'])) $city = $get;

        $fetcher = new cityFetcher();
        $obj = $fetcher->fetchCity($city);
        $latitude = $obj->lat; 
        $longitude = $obj->long;

        // Initialize cURL session
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.open-meteo.com/v1/forecast?latitude=$latitude&longitude=$longitude&hourly=temperature_2m,weathercode");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new \Exception('cURL Error: ' . curl_error($ch));
        }

        curl_close($ch);

        $weatherData = json_decode($response, true);
        //var_dump($weatherData);
        $times = $weatherData['hourly']['time'];
        $temps = $weatherData['hourly']['temperature_2m'];
        $weatherCodes = $weatherData['hourly']['weathercode'];
        
        $now = date("Y-m-d") . "T" . date("H") . ":00";
        $index = array_search($now, $times);

        if ($index === false) {
            throw new \Exception("Current time not found in API response");
        }

        $temp = (int)$temps[$index];
        $weatherCode = $weatherCodes[$index];

        // Map weather code to a description
        $weatherDescription = $weatherTypes[$weatherCode] ?? 'Unknown';
        return new WeatherInfo($city, $temp, $weatherDescription);
    }
}
