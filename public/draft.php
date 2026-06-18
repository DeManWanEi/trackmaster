<?php

session_start();

require_once __DIR__ . '/../src/Data/CarsRepository.php';
require_once __DIR__ . '/../src/Data/TracksRepository.php';
require_once __DIR__ . '/../src/Core/Draft.php';

$cars = CarsRepository::getCars();
$tracks = TracksRepository::getTracks();

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
| GENERAR DRAFT PLAYER
|--------------------------------------------------------------------------
*/
$playerBrand = Draft::rollBrand($cars);
$playerDecade = Draft::rollDecade($cars, $playerBrand);
$playerDraft = Draft::getDraft($cars, $playerBrand, $playerDecade);

/*
|--------------------------------------------------------------------------
| GENERAR DRAFT IA
|--------------------------------------------------------------------------
*/
do {
    $aiBrand = Draft::rollBrand($cars);
    $aiDecade = Draft::rollDecade($cars, $aiBrand);
} while ($aiBrand === $playerBrand && $aiDecade === $playerDecade);

$aiDraft = Draft::getDraft($cars, $aiBrand, $aiDecade);

/*
|--------------------------------------------------------------------------
| GUARDAR EN SESIÓN
|--------------------------------------------------------------------------
*/
$_SESSION['player_draft'] = array_map(fn($c) => [
    "name" => $c->name,
    "brand" => $c->brand,
    "decade" => $c->decade,
    "image" => $c->image ?? "/assets/cars/default.png"
], $playerDraft);

$_SESSION['ai_draft'] = array_map(fn($c) => [
    "name" => $c->name,
    "brand" => $c->brand,
    "decade" => $c->decade,
    "image" => $c->image ?? "/assets/cars/default.png"
], $aiDraft);

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

<div class="card">
<strong>🏁 Circuito:</strong> <?= $track->name ?>
</div>

<div class="card">

<form method="POST" action="/game.php">
    <input type="hidden" name="action" value="run_race">

    <div class="draft-grid">

        <?php foreach ($_SESSION['player_draft'] as $i => $car): ?>

            <label class="car-card">
                <input type="radio" name="car" value="<?= $i ?>" required>

                <img src="<?= $car['image']['src'] ?>">

                <div><strong><?= $car['name'] ?></strong></div>

                <div><?= $car['brand'] ?> · <?= $car['decade'] ?></div>

            </label>

        <?php endforeach; ?>

    </div>

    <br>

    <div style="text-align:center;">
        <button>🏁 Correr carrera</button>
    </div>

</form>

</div>

</div>

</body>
</html>