<?php

require_once __DIR__ . "/../Models/Car.php";

/*
 * Stats:
 * pwr = aceleración / potencia
 * grp = agarre
 * hnd = manejo
 * trc = tracción
 * spd = velocidad punta
 */

function getCars(): array {

    return [

        // =========================================================
        // 🟦 AUDI 80s
        // =========================================================
        new Car("Audi Quattro", "Audi", "80s", "A", 68, 74, 72, 78, 70),
        new Car("Audi Sport Quattro S1", "Audi", "80s", "A", 75, 70, 72, 74, 78),
        new Car("Audi 80 GLE", "Audi", "80s", "C", 38, 45, 46, 50, 40),
        new Car("Audi Coupe GT", "Audi", "80s", "C", 42, 48, 50, 52, 44),
        new Car("Audi 100 CS", "Audi", "80s", "C", 35, 42, 44, 48, 38),

        // =========================================================
        // 🟦 AUDI 90s
        // =========================================================
        new Car("Audi RS2 Avant", "Audi", "90s", "A", 78, 80, 76, 82, 80),
        new Car("Audi A4 DTM", "Audi", "90s", "A", 80, 78, 80, 78, 82),
        new Car("Audi S2 Coupe", "Audi", "90s", "B", 62, 64, 63, 66, 60),
        new Car("Audi A3 1.8T", "Audi", "90s", "B", 55, 58, 58, 60, 56),
        new Car("Audi Cabriolet", "Audi", "90s", "C", 45, 48, 50, 52, 46),

        // =========================================================
        // 🟦 BMW 80s
        // =========================================================
        new Car("BMW M3 E30", "BMW", "80s", "A", 74, 82, 84, 78, 76),
        new Car("BMW M635 CSi", "BMW", "80s", "B", 60, 68, 66, 64, 65),
        new Car("BMW 325i E30", "BMW", "80s", "C", 48, 54, 56, 52, 50),
        new Car("BMW 528i E28", "BMW", "80s", "C", 45, 50, 52, 50, 48),
        new Car("BMW 318i E30", "BMW", "80s", "C", 42, 48, 50, 48, 46),

        // =========================================================
        // 🟦 BMW 90s
        // =========================================================
        new Car("BMW M3 E36", "BMW", "90s", "A", 76, 80, 82, 78, 80),
        new Car("BMW M5 E34", "BMW", "90s", "A", 80, 74, 72, 76, 84),
        new Car("BMW 318is E36", "BMW", "90s", "B", 58, 62, 64, 62, 60),
        new Car("BMW Z3", "BMW", "90s", "B", 60, 64, 66, 64, 62),
        new Car("BMW 316i Compact", "BMW", "90s", "C", 42, 48, 50, 48, 44),

        // =========================================================
        // 🟥 FORD 80s
        // =========================================================
        new Car("Ford Sierra RS Cosworth", "Ford", "80s", "A", 78, 76, 74, 80, 82),
        new Car("Ford Escort MK2", "Ford", "80s", "B", 55, 62, 64, 66, 58),
        new Car("Ford Capri 2.8", "Ford", "80s", "C", 48, 52, 54, 52, 50),
        new Car("Ford Fiesta XR2", "Ford", "80s", "C", 42, 46, 48, 50, 44),
        new Car("Ford Sierra 1.6", "Ford", "80s", "C", 38, 44, 46, 48, 42),

        // =========================================================
        // 🟥 FORD 90s
        // =========================================================
        new Car("Ford Escort RS Cosworth", "Ford", "90s", "A", 80, 78, 76, 82, 82),
        new Car("Ford Mondeo ST24", "Ford", "90s", "B", 60, 62, 62, 64, 62),
        new Car("Ford Puma", "Ford", "90s", "C", 45, 48, 50, 50, 46),

        // =========================================================
        // 🟩 SUBARU 90s
        // =========================================================
        new Car("Subaru Impreza WRX", "Subaru", "90s", "A", 76, 78, 80, 84, 78),
        new Car("Subaru Legacy RS", "Subaru", "90s", "B", 60, 62, 64, 68, 60),
        new Car("Subaru Justy", "Subaru", "90s", "C", 35, 40, 42, 46, 38),
        new Car("Subaru Vivio", "Subaru", "90s", "C", 32, 38, 40, 44, 36),
        new Car("Subaru Impreza 1.6", "Subaru", "90s", "C", 40, 44, 46, 48, 42),

        // =========================================================
        // 🟩 NISSAN 90s
        // =========================================================
        new Car("Nissan Skyline R32 GT-R", "Nissan", "90s", "A", 82, 80, 78, 84, 86),
        new Car("Nissan 200SX S13", "Nissan", "90s", "B", 62, 64, 66, 66, 64),
        new Car("Nissan Sunny GTI", "Nissan", "90s", "C", 45, 48, 50, 52, 46),
        new Car("Nissan Micra K11", "Nissan", "90s", "C", 32, 38, 40, 42, 34),
        new Car("Nissan Primera", "Nissan", "90s", "B", 55, 58, 60, 62, 56),
    ];
}