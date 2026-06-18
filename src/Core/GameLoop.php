<?php

require_once __DIR__ . "/Draft.php";
require_once __DIR__ . "/Race.php";

class GameLoop
{
    private array $cars;
    private array $tracks;
    private Simulator $sim;

    private bool $debug = true;

    public function __construct(array $cars, array $tracks, Simulator $sim)
    {
        $this->cars = $cars;
        $this->tracks = $tracks;
        $this->sim = $sim;
    }

    public function run(): void
    {
        echo "=========================\n";
        echo "🏁 TRACKMASTER\n";
        echo "=========================\n\n";

        $difficulty = $this->chooseDifficulty();

        echo "\n🎚️ Dificultad: " . ($difficulty === "hard" ? "Difícil" : "Normal") . "\n\n";

        $playerPoints = 0;
        $aiPoints = 0;

        // =====================================================
        // 🏁 CARRERAS
        // =====================================================
        foreach ($this->tracks as $track) {

            echo "=========================\n";
            echo "🏁 PRUEBA: {$track->name}\n";
            echo "=========================\n\n";

            // =================================================
            // 🎮 DRAFT JUGADOR (POR CARRERA)
            // =================================================
            $playerBrand = Draft::rollBrand($this->cars);
            $playerDecade = Draft::rollDecade($this->cars, $playerBrand);

            $playerDraft = Draft::getDraft(
                $this->cars,
                $playerBrand,
                $playerDecade
            );

            echo "🎮 TU DRAFT ({$playerBrand} - {$playerDecade})\n\n";

            foreach ($playerDraft as $i => $car) {
                echo ($i + 1) . ". {$car->name}\n";
            }

            $playerCar = $this->playerPick($playerDraft);

            echo "\n🎮 ELIGES: {$playerCar->name}\n\n";

            // =================================================
            // 🤖 DRAFT IA (POR CARRERA, DIFERENTE)
            // =================================================
            do {

                $aiBrand = Draft::rollBrand($this->cars);
                $aiDecade = Draft::rollDecade($this->cars, $aiBrand);

            } while (
                $aiBrand === $playerBrand &&
                $aiDecade === $playerDecade
            );

            $aiDraft = Draft::getDraft(
                $this->cars,
                $aiBrand,
                $aiDecade
            );

            if ($this->debug) {

                echo "🤖 IA DRAFT ({$aiBrand} - {$aiDecade})\n\n";

                foreach ($aiDraft as $i => $car) {
                    echo ($i + 1) . ". {$car->name}\n";
                }

                echo "\n";
            }

            $aiCar = $this->aiPick($aiDraft, $track, $difficulty);

            echo "🤖 IA ELIGE: {$aiCar->name}\n\n";

            // =================================================
            // 🏁 CARRERA
            // =================================================
            $race = new Race(
                [$playerCar, $aiCar],
                $track,
                $this->sim
            );

            $results = $race->run();

            foreach ($results as $i => $result) {

                echo ($i + 1) . ". ";
                echo $result["car"]->name;
                echo " → ";
                echo $this->formatTime($result["time"]);
                echo "\n";
            }

            echo "\n";

            if ($results[0]["car"] === $playerCar) {
                echo "🏆 GANAS LA PRUEBA\n\n";
                $playerPoints++;
            } else {
                echo "🤖 GANA LA IA\n\n";
                $aiPoints++;
            }
        }

        // =====================================================
        // 🏆 FINAL
        // =====================================================
        echo "=========================\n";
        echo "🏆 RESULTADO FINAL\n";
        echo "=========================\n\n";

        echo "Tú: {$playerPoints}\n";
        echo "IA: {$aiPoints}\n\n";

        if ($playerPoints > $aiPoints) {
            echo "🎉 HAS GANADO\n";
        } elseif ($aiPoints > $playerPoints) {
            echo "🤖 HA GANADO LA IA\n";
        } else {
            echo "🤝 EMPATE\n";
        }
    }

    // =========================================================
    // 🎚️ DIFICULTAD
    // =========================================================
    private function chooseDifficulty(): string
    {
        echo "🎚️ DIFICULTAD\n";
        echo "1. Normal\n";
        echo "2. Difícil\n\n";
        echo "👉 ";

        return trim(fgets(STDIN)) === "2" ? "hard" : "normal";
    }

    // =========================================================
    // 🎮 PLAYER PICK
    // =========================================================
    private function playerPick(array $draft): Car
    {
        echo "\n👉 ELIGE COCHE (1-5): ";
        $index = (int) trim(fgets(STDIN)) - 1;

        return $draft[$index] ?? $draft[array_rand($draft)];
    }

    // =========================================================
    // 🤖 IA CON AWARENESS DEL CIRCUITO
    // =========================================================
    private function aiPick(array $draft, Track $track, string $difficulty): Car
    {
        $scores = [];

        foreach ($draft as $car) {

            $score = 0;

            foreach ($track->weights as $stat => $weight) {
                $score += ($car->$stat ?? 0) * $weight;
            }

            $scores[] = [
                "car" => $car,
                "score" => $score
            ];
        }

        usort($scores, fn($a, $b) => $b["score"] <=> $a["score"]);

        if ($difficulty === "hard") {
            return $scores[0]["car"];
        }

        // normal: sesgo probabilístico
        $pool = [];

        foreach ($scores as $i => $entry) {

            $weight = match ($i) {
                0 => 50,
                1 => 30,
                2 => 15,
                default => 5
            };

            for ($j = 0; $j < $weight; $j++) {
                $pool[] = $entry["car"];
            }
        }

        return $pool[array_rand($pool)];
    }

    // =========================================================
    // ⏱️ FORMATO TIEMPO
    // =========================================================
    private function formatTime(float $time): string
    {
        if ($time < 60) {
            return number_format($time, 2) . "s";
        }

        $m = floor($time / 60);
        $s = floor($time % 60);
        $cs = (int)(($time - floor($time)) * 100);

        return sprintf("%02d:%02d.%02d", $m, $s, $cs);
    }
}