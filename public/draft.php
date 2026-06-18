<?php

session_start();

require_once __DIR__ . '/../src/Data/CarsPool.php';
require_once __DIR__ . '/../src/Data/TracksPool.php';
require_once __DIR__ . '/../src/Core/Draft.php';

$cars = getCars();
$tracks = getTracks();

$game = $_SESSION['game'] ?? null;

if (!$game) {
    die("❌ No hay partida activa");
}

$currentTrack = $game['currentTrack'] ?? 0;

if (!isset($tracks[$currentTrack])) {
    header("Location: /result.php?end=1");
    exit;
}

$track = $tracks[$currentTrack];

/*
|--------------------------------------------------------------------------
| 🎲 GENERAR DRAFT PLAYER
|--------------------------------------------------------------------------
*/
$playerBrand = Draft::rollBrand($cars);
$playerDecade = Draft::rollDecade($cars, $playerBrand);
$playerDraft = Draft::getDraft($cars, $playerBrand, $playerDecade);

/*
|--------------------------------------------------------------------------
| 🎲 GENERAR DRAFT IA
|--------------------------------------------------------------------------
*/
do {
    $aiBrand = Draft::rollBrand($cars);
    $aiDecade = Draft::rollDecade($cars, $aiBrand);
} while ($aiBrand === $playerBrand && $aiDecade === $playerDecade);

$aiDraft = Draft::getDraft($cars, $aiBrand, $aiDecade);

/*
|--------------------------------------------------------------------------
| 💾 GUARDAR EN SESIÓN
|--------------------------------------------------------------------------
*/
$_SESSION['player_draft'] = array_map(fn($c) => [
    "name" => $c->name
], $playerDraft);

$_SESSION['ai_draft'] = array_map(fn($c) => [
    "name" => $c->name
], $aiDraft);

$_SESSION['draft_context'] = [
    "playerBrand" => $playerBrand,
    "playerDecade" => $playerDecade,
    "aiBrand" => $aiBrand,
    "aiDecade" => $aiDecade
];

?>

<!DOCTYPE html>
<html>
<head>
    <title>Draft</title>
    <link rel="stylesheet" href="/assets/style.css">
</head>
<body>

<div class="container">

<h1>🎮 Elige tu coche</h1>

<div class="card info">
    <strong>🏁 Circuito:</strong> <?= $track->name ?>
</div>

<div class="card info">
    <strong>📦 Tu pool:</strong><br>
    Marca: <?= $playerBrand ?><br>
    Década: <?= $playerDecade ?>
</div>

<div class="card">

<form method="POST" action="/game.php">
    <input type="hidden" name="action" value="run_race">

    <?php foreach ($_SESSION['player_draft'] as $i => $car): ?>
        <label>
            <input type="radio" name="car" value="<?= $i ?>" required>
            <?= $car['name'] ?>
        </label>
    <?php endforeach; ?>

    <br><br>
    <button>🏁 Correr carrera</button>
</form>

</div>

</div>

</body>
</html>