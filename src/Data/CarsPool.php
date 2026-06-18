<?php

require_once __DIR__ . "/../Models/Car.php";

function getCars(): array {


/*
 * Orden de stats en cada coche:
 *
 * pwr = Power (Potencia)
 * grp = Grip (Agarre)
 * hnd = Handling (Manejo)
 * trc = Traction (Tracción)
 * spd = Speed (Velocidad punta)
 */


    return [               // pwr grp hnd, trc, spd
        new Car("Radical SR3", 60, 90, 90, 70, 70),
        new Car("Dodge Demon", 90, 55, 60, 65, 80),
        new Car("Subaru WRX", 50, 70, 75, 90, 45),
    ];
}