<?php

require_once __DIR__ . "/../Models/Track.php";

function getTracks(): array {

    return [
        //Distancia metros, factor velocidad (ajustar tiempos)
        new Track("Le Mans", [
            "spd" => 0.5,
            "acc" => 0.25,
            "grp" => 0.1,
            "hnd" => 0.15
        ], 13626, 0.26),

        new Track("Slalom", [
            "crn" => 0.5,
            "hnd" => 0.3,
            "grp" => 0.2
        ], 500, 0.6),

        new Track("Drag 1KM", [
            "acc" => 0.5,
            "spd" => 0.4,
            "hnd" => 0.1
        ], 1000, 0.22),

    ];
}