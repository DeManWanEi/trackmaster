<?php

session_start();

require_once __DIR__ . '/../src/Data/CarsRepository.php';
require_once __DIR__ . '/../src/Data/TracksRepository.php';
require_once __DIR__ . '/../src/Core/Race.php';
require_once __DIR__ . '/../src/Core/Simulator.php';

$cars = CarsRepository::getCars();
$tracks = TracksRepository::getTracks();

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
        "difficulty" => $_POST['difficulty'] ?? 'normal',
        "playerPoints" => 0,
        "aiPoints" => 0,
        "currentTrack" => 0,
        "lastResults" => []
    ];

    // limpiar estado previo
    unset($_SESSION['player_draft'], $_SESSION['ai_draft']);

    header("Location: /draft.php");
    exit;
}

/*
|--------------------------------------------------------------------------
| RUN RACE
|--------------------------------------------------------------------------
*/
if ($action === 'run_race') {

    $game = $_SESSION['game'] ?? null;

    if (!$game) {
        header("Location: /index.php");
        exit;
    }

    $trackIndex = $game['currentTrack'];

    if (!isset($tracks[$trackIndex])) {
        header("Location: /result.php?end=1");
        exit;
    }

    $track = $tracks[$trackIndex];

    $playerCarIndex = (int)$_POST['car'];

    $playerCar = $_SESSION['player_draft'][$playerCarIndex] ?? null;
    $aiCar = $_SESSION['ai_draft'][array_rand($_SESSION['ai_draft'] ?? [])] ?? null;

    if (!$playerCar || !$aiCar) {
        die("❌ Draft inválido");
    }

    $allCars = CarsRepository::getCars();

    $playerCarObj = findCar($allCars, $playerCar['name']);
    $aiCarObj = findCar($allCars, $aiCar['name']);

    if (!$playerCarObj || !$aiCarObj) {
        die("❌ Coche no encontrado");
    }

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