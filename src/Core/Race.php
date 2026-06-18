<?php

class Race {

    private array $cars;
    private array $tracks;
    private Simulator $sim;

    public function __construct(array $cars, array $tracks, Simulator $sim) {
        $this->cars = $cars;
        $this->tracks = $tracks;
        $this->sim = $sim;
    }

    public function run() {

        echo "🏁 INICIO DE CARRERA\n\n";

        // 🎚️ escala global del juego
        $SCALE = 0.1;

        foreach ($this->tracks as $track) {

            echo "Prueba: {$track->name} ({$track->length}m)\n\n";

            $results = [];

            foreach ($this->cars as $car) {

                $perf = $this->sim->simulate($car, $track);

                // 🧠 tiempo SIEMPRE float (evita warnings PHP 8)
                $time = (float)(($track->length / $perf) * $track->timeFactor * $SCALE);

                $results[] = [
                    "car" => $car->name,
                    "time" => $time
                ];
            }

            // 🏁 ordenar por tiempo (más rápido primero)
            usort($results, fn($a, $b) => $a["time"] <=> $b["time"]);

            foreach ($results as $i => $r) {

                // 🧠 formateo seguro (no afecta tipo interno)
                echo ($i + 1) . ". " .
                    $r["car"] .
                    " → " .
                    $this->formatTime((float)$r["time"]) .
                    "\n";
            }

            echo "\n";
        }

        echo "🏁 FIN DE CARRERA\n";
    }

    /**
     * ⏱️ Formatea segundos a s / mm:ss
     */
private function formatTime(float $time): string {

    $totalSeconds = (float) $time;

    $minutes = (int) floor($totalSeconds / 60);

    // 🔥 CLAVE: evitar operador % con floats
    $seconds = (int) floor($totalSeconds - ($minutes * 60));

    $centiseconds = (int) round(($totalSeconds - floor($totalSeconds)) * 100);

    // 🔧 normalización de overflow
    if ($centiseconds === 100) {
        $centiseconds = 0;
        $seconds++;
    }

    if ($seconds === 60) {
        $seconds = 0;
        $minutes++;
    }

    // 🧾 formato final
    if ($minutes > 0) {
        return sprintf("%d:%02d.%02d", $minutes, $seconds, $centiseconds);
    }

    return sprintf("%d.%02d s", $seconds, $centiseconds);
}
}