<?php

session_start();

require_once __DIR__ . '/../src/Data/CarsPool.php';
require_once __DIR__ . '/../src/Data/TracksPool.php';

$cars = getCars();
$tracks = getTracks();

?>

<!DOCTYPE html>
<html>
<head>
    <title>TrackMaster</title>
    <link rel="stylesheet" href="/assets/style.css">
</head>
<body>

<div class="container">

<h1>🏁 TrackMaster</h1>

<div class="card">

<form method="POST" action="/game.php">

    <input type="hidden" name="action" value="start">

    <label>Dificultad:</label>
    <select name="difficulty">
        <option value="normal">Normal</option>
        <option value="hard">Difícil</option>
    </select>

    <br><br>

    <button>Empezar partida</button>
</form>

</div>

</div>

</body>
</html>