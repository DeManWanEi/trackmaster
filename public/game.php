<?php

session_start();

require_once __DIR__ . '/../src/Data/CarsPool.php';
require_once __DIR__ . '/../src/Data/TracksPool.php';
require_once __DIR__ . '/../src/Core/Draft.php';
require_once __DIR__ . '/../src/Core/Race.php';
require_once __DIR__ . '/../src/Core/Simulator.php';

$cars = getCars();
$tracks = getTracks();

$action = $_POST['action'] ?? null;

if (!$action) {
    header("Location: /index.php");
    exit;
}

/*
|--------------------------------------------------------------------------
| START GAME
|--------------------------------------------------------------------------
*/
if ($action === 'start') {

    $_SESSION['game'] = [
        "difficulty" => $_POST['difficulty'],
        "playerPoints" => 0,
        "aiPoints" => 0,
        "currentTrack" => 0,
        "lastResults" => []
    ];

    header("Location: /draft.php");
    exit;
}

/*
|--------------------------------------------------------------------------
| RUN RACE
|--------------------------------------------------------------------------
*/
if ($action === 'run_race') {

    $game = $_SESSION['game'];

    $trackIndex = $game['currentTrack'];

    if (!isset($tracks[$trackIndex])) {
        header("Location: /result.php?end=1");
        exit;
    }

    $track = $tracks[$trackIndex];

    $playerCarIndex = (int)$_POST['car'];

    $playerCar = $_SESSION['player_draft'][$playerCarIndex];
    $aiCar = $_SESSION['ai_draft'][array_rand($_SESSION['ai_draft'])];

    $allCars = getCars();

    $playerCarObj = findCar($allCars, $playerCar['name']);
    $aiCarObj = findCar($allCars, $aiCar['name']);

    $race = new Race([$playerCarObj, $aiCarObj], $track, new Simulator());

    $results = $race->run();

    $game['lastResults'] = $results;
    $game['currentTrack']++;

    if ($results[0]['car']['name'] === $playerCarObj->name) {
        $game['playerPoints']++;
    } else {
        $game['aiPoints']++;
    }

    $_SESSION['game'] = $game;

    header("Location: /result.php");
    exit;
}

header("Location: /index.php");
exit;

function findCar(array $cars, string $name)
{
    foreach ($cars as $car) {
        if ($car->name === $name) return $car;
    }
    return null;
}