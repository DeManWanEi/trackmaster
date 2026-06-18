<?php

require_once __DIR__ . "/../src/Data/CarsPool.php";
require_once __DIR__ . "/../src/Data/TracksPool.php";

require_once __DIR__ . "/../src/Core/Simulator.php";
require_once __DIR__ . "/../src/Core/GameLoop.php";

$cars = getCars();
$tracks = getTracks();

$sim = new Simulator();

$game = new GameLoop($cars, $tracks, $sim);
$game->run();