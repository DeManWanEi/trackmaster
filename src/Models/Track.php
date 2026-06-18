<?php

class Track {

    public string $name;

    /*
     * PESOS DE LA PRUEBA
     *
     * Indican qué stats son importantes en esta prueba.
     * Se usan como multiplicadores del rendimiento del coche.
     *
     * Ejemplo:
     * "spd" => 0.5 significa que la velocidad punta es muy importante.
     */

    public array $weights;

    public int $length; //metros

    public float $timeFactor; //ajustar lo que tarda en realizarse una prueba

     public function __construct(
        string $name,
        array $weights,
        int $length,
        float $timeFactor = 1.0
    ) {
        $this->name = $name;
        $this->weights = $weights;
        $this->length = $length;
        $this->timeFactor = $timeFactor;
    }
}