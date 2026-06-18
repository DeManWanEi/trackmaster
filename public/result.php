<?php

session_start();

require_once __DIR__ . '/../src/Data/TracksRepository.php';

$game = $_SESSION['game'] ?? null;

if (!$game) {
    die("❌ No hay partida activa");
}

$currentTrack = $game['currentTrack'] ?? 0;
$tracks = TracksRepository::getTracks();

$hasNext = isset($tracks[$currentTrack]);

$end = $_GET['end'] ?? false;

/*
|--------------------------------------
| FORMAT TIME
|--------------------------------------
*/
function formatTime(float $time): string
{
    $totalSeconds = (int) floor($time);

    $minutes = intdiv($totalSeconds, 60);
    $seconds = $totalSeconds % 60;

    $centiseconds = (int) round(($time - $totalSeconds) * 100);

    if ($centiseconds === 100) {
        $centiseconds = 0;
        $seconds++;

        if ($seconds === 60) {
            $seconds = 0;
            $minutes++;
        }
    }

    if ($minutes > 0) {
        return sprintf("%d:%02d:%02d", $minutes, $seconds, $centiseconds);
    }

    return sprintf("%d.%02d s", $seconds, $centiseconds);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Resultado</title>
    <link rel="stylesheet" href="/assets/style.css">
</head>
<body>

<div class="container">

<h1>Resultado</h1>

<div class="card">

<?php foreach ($game['lastResults'] as $i => $r): ?>
    <div class="result">
        <?= $i + 1 ?>.
        <?= $r['car']['name'] ?>
        → <?= formatTime($r['time']) ?>
    </div>
<?php endforeach; ?>

</div>

<div class="card">
    <strong>Jugador:</strong> <?= $game['playerPoints'] ?>
    <br>
    <strong>IA:</strong> <?= $game['aiPoints'] ?>
</div>

<?php if ($hasNext): ?>
    <form method="GET" action="/draft.php">
        <button>Siguiente carrera</button>
    </form>
<?php else: ?>
    <h2>🏆 Campeonato terminado</h2>

    <form method="GET" action="/index.php">
        <button>Volver a empezar</button>
    </form>
<?php endif; ?>

</div>

</body>
</html>