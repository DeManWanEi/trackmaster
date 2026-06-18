<?php

require_once __DIR__ . "/../Models/Car.php";

/*
 * Orden de stats en cada coche:
 *
 * pwr = Power (Potencia)
 * grp = Grip (Agarre)
 * hnd = Handling (Manejo)
 * trc = Traction (Tracción)
 * spd = Speed (Velocidad punta)
 */

function getCars(): array {

    return [

        // =========================================================
        // 🟦 AUDI 80s
        // =========================================================
        new Car("Audi Quattro", "Audi", "80s", "A", 70, 75, 72, 73, 70),
        new Car("Audi Sport Quattro S1", "Audi", "80s", "A", 75, 72, 74, 70, 75),
        new Car("Audi 80 GLE", "Audi", "80s", "C", 45, 50, 48, 52, 45),
        new Car("Audi Coupe GT", "Audi", "80s", "C", 48, 52, 50, 50, 47),
        new Car("Audi 100 CS", "Audi", "80s", "C", 42, 48, 46, 50, 44),

        // =========================================================
        // 🟦 AUDI 90s
        // =========================================================
        new Car("Audi RS2 Avant", "Audi", "90s", "A", 78, 76, 74, 80, 76),
        new Car("Audi A4 DTM", "Audi", "90s", "A", 80, 74, 76, 78, 79),
        new Car("Audi S2 Coupe", "Audi", "90s", "B", 62, 64, 63, 66, 60),
        new Car("Audi A3 1.8T", "Audi", "90s", "B", 58, 60, 60, 63, 57),
        new Car("Audi Cabriolet", "Audi", "90s", "C", 50, 52, 51, 54, 49),

        // =========================================================
        // 🟦 BMW 80s
        // =========================================================
        new Car("BMW M3 E30", "BMW", "80s", "A", 76, 80, 82, 78, 75),
        new Car("BMW M635 CSi", "BMW", "80s", "B", 65, 68, 66, 65, 67),
        new Car("BMW 325i E30", "BMW", "80s", "C", 52, 55, 58, 54, 53),
        new Car("BMW 528i E28", "BMW", "80s", "C", 50, 53, 51, 52, 50),
        new Car("BMW 318i E30", "BMW", "80s", "C", 48, 50, 52, 50, 48),

        // =========================================================
        // 🟦 BMW 90s
        // =========================================================
        new Car("BMW M3 E36", "BMW", "90s", "A", 78, 78, 78, 76, 77),
        new Car("BMW M5 E34", "BMW", "90s", "A", 80, 74, 72, 75, 82),
        new Car("BMW 318is E36", "BMW", "90s", "B", 60, 62, 64, 63, 59),
        new Car("BMW Z3", "BMW", "90s", "B", 62, 65, 66, 63, 61),
        new Car("BMW 316i Compact", "BMW", "90s", "C", 48, 50, 52, 50, 47),

        // =========================================================
        // 🟥 FORD 80s
        // =========================================================
        new Car("Ford Sierra RS Cosworth", "Ford", "80s", "A", 78, 76, 74, 80, 78),
        new Car("Ford Escort MK2", "Ford", "80s", "B", 60, 64, 63, 65, 58),
        new Car("Ford Capri 2.8", "Ford", "80s", "C", 52, 55, 54, 52, 53),
        new Car("Ford Fiesta XR2", "Ford", "80s", "C", 50, 52, 54, 55, 50),
        new Car("Ford Sierra 1.6", "Ford", "80s", "C", 45, 48, 50, 52, 46),

        // =========================================================
        // 🟥 FORD 90s
        // =========================================================
        new Car("Ford Escort RS Cosworth", "Ford", "90s", "A", 80, 78, 76, 82, 80),
        new Car("Ford Mondeo ST24", "Ford", "90s", "B", 62, 64, 64, 66, 62),
        new Car("Ford Puma", "Ford", "90s", "C", 50, 52, 54, 52, 50),

        // =========================================================
        // 🟩 SUBARU 90s
        // =========================================================
        new Car("Subaru Impreza WRX", "Subaru", "90s", "A", 75, 76, 78, 82, 74),
        new Car("Subaru Legacy RS", "Subaru", "90s", "B", 62, 64, 66, 70, 60),
        new Car("Subaru Justy", "Subaru", "90s", "C", 45, 48, 50, 52, 44),
        new Car("Subaru Vivio", "Subaru", "90s", "C", 40, 45, 48, 50, 42),
        new Car("Subaru Impreza 1.6", "Subaru", "90s", "C", 48, 50, 52, 55, 46),

        // =========================================================
        // 🟩 NISSAN 90s
        // =========================================================
        new Car("Nissan Skyline R32 GT-R", "Nissan", "90s", "A", 82, 80, 78, 82, 84),
        new Car("Nissan 200SX S13", "Nissan", "90s", "B", 65, 66, 68, 67, 64),
        new Car("Nissan Sunny GTI", "Nissan", "90s", "C", 52, 54, 53, 55, 52),
        new Car("Nissan Micra K11", "Nissan", "90s", "C", 40, 45, 48, 50, 42),
        new Car("Nissan Primera", "Nissan", "90s", "B", 58, 60, 62, 63, 57),
    ];
}