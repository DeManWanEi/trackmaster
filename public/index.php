<?php
session_start();
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

    <div class="difficulty-group">

        <div class="difficulty-option">
            <input type="radio" id="normal" name="difficulty" value="normal" checked>
            <label for="normal">Normal</label>
        </div>

        <div class="difficulty-option">
            <input type="radio" id="hard" name="difficulty" value="hard">
            <label for="hard">Difícil</label>
        </div>

    </div>

    <div style="text-align:center;">
        <button type="submit">Empezar partida</button>
    </div>

</form>

</div>

</div>

</body>
</html>