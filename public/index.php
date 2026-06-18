<?php

require_once __DIR__ . "/../src/Models/Car.php";
require_once __DIR__ . "/../src/Models/Track.php";
require_once __DIR__ . "/../src/Core/Simulator.php";
require_once __DIR__ . "/../src/Core/Race.php";
require_once __DIR__ . "/../src/Data/CarsPool.php";
require_once __DIR__ . "/../src/Data/TracksPool.php";

$cars = getCars();
$tracks = getTracks();

$sim = new Simulator();

$race = new Race($cars, $tracks, $sim);

$race->run();