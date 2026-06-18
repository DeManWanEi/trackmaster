<?php

require_once __DIR__ . "/Draft.php";
require_once __DIR__ . "/Race.php";

class GameLoop {

    private array $cars;
    private array $tracks;
    private Simulator $sim;

    public function __construct(array $cars, array $tracks, Simulator $sim) {
        $this->cars = $cars;
        $this->tracks = $tracks;
        $this->sim = $sim;
    }

    public function run() {

        echo "=========================\n";
        echo "🏁 GAME LOOP START\n";
        echo "=========================\n\n";

        $allCars = $this->cars;

        // =====================================================
        // 🎮 DRAFT JUGADOR
        // =====================================================
        $playerBrand = Draft::rollBrand($allCars);
        $playerDecade = Draft::rollDecade($allCars, $playerBrand);
        $playerDraft = Draft::getDraft($allCars, $playerBrand, $playerDecade);

        echo "🎮 TU DRAFT:\n";
        echo "Marca: $playerBrand | Década: $playerDecade\n\n";

        foreach ($playerDraft as $i => $car) {
            echo ($i + 1) . ". {$car->name} (Tier {$car->tier})\n";
        }

        // 🎮 SELECCIÓN REAL DEL JUGADOR
        $playerCar = $this->playerPick($playerDraft);

        echo "\n🎮 HAS ELEGIDO: {$playerCar->name}\n\n";

        // =====================================================
        // 🤖 DRAFT IA (TOTALMENTE DIFERENTE)
        // =====================================================

        do {
            $aiBrand = Draft::rollBrand($allCars);
            $aiDecade = Draft::rollDecade($allCars, $aiBrand);
        } while ($aiBrand === $playerBrand && $aiDecade === $playerDecade);

        $aiDraft = Draft::getDraft($allCars, $aiBrand, $aiDecade);

        echo "🤖 DRAFT IA:\n";
        echo "Marca: $aiBrand | Década: $aiDecade\n\n";

        foreach ($aiDraft as $car) {
            echo "- {$car->name}\n";
        }

        // 🤖 IA elige el mejor coche del draft
        $aiCar = $this->aiPick($aiDraft);

        echo "\n🤖 IA ELIGE: {$aiCar->name}\n\n";

        // =====================================================
        // 🏁 CARRERA
        // =====================================================

        $race = new Race([$playerCar, $aiCar], $this->tracks, $this->sim);
        $race->run();

        echo "\n=========================\n";
        echo "🏁 GAME LOOP END\n";
        echo "=========================\n";
    }

    // =========================================================
    // 🎮 INPUT JUGADOR REAL
    // =========================================================
    private function playerPick(array $draft) {

        echo "\n👉 ELIGE TU COCHE (1-5): ";

        $input = trim(fgets(STDIN));
        $index = (int)$input - 1;

        if (!isset($draft[$index])) {
            echo "❌ Selección inválida, se elige aleatorio.\n";
            return $draft[array_rand($draft)];
        }

        return $draft[$index];
    }

    // =========================================================
    // 🤖 IA SIMPLE (MEJOR COCHE DEL DRAFT)
    // =========================================================
    private function aiPick(array $draft) {

        $best = null;
        $bestScore = -1;

        foreach ($draft as $car) {

            $score = $car->getPowerScore();

            if ($score > $bestScore) {
                $bestScore = $score;
                $best = $car;
            }
        }

        return $best;
    }
}