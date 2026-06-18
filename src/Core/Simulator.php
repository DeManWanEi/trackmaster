<?php

class Simulator {

    public function simulate(Car $car, Track $track): float {

        $acc = ($car->pwr * 0.6) + ($car->trc * 0.4);
        $crn = ($car->grp * 0.5) + ($car->hnd * 0.5);

        $stats = [
            "pwr" => $car->pwr,
            "grp" => $car->grp,
            "hnd" => $car->hnd,
            "trc" => $car->trc,
            "spd" => $car->spd,
            "acc" => $acc,
            "crn" => $crn
        ];

        $performance = 0;

        foreach ($track->weights as $stat => $weight) {
            $performance += $stats[$stat] * $weight;
        }

        // 🎯 normalización (clave del sistema)
        $performance = $performance / 100;

        // 🎲 RNG controlado (±5%)
        $noise = rand(-5, 5) / 100;
        $performance *= (1 + $noise);

        // 🚗 eficiencia final (0.6 - 1.4 aprox)
        return 0.8 + ($performance * 0.6);
    }
}