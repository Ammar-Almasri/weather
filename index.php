<?php

use App\Weather\realWeatherFetcher;
use App\Weather\fakeWeatherFetcher;

require __DIR__ . "/inc/all.inc.php";

$fetcher = new realWeatherFetcher();
$info = $fetcher->fetch('Amman');




require __DIR__ . "/views/index.veiw.php";