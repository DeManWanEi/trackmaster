<?php

class Car {

    public string $name;
    public string $brand;
    public string $decade;

    public string $tier; // C, B, A (balance global del coche)

    // 🚗 Stats base del coche (escala 35–85 aprox)
    public int $pwr; // potencia (aceleración / salida)
    public int $grp; // agarre
    public int $hnd; // manejo / curvas
    public int $trc; // tracción / estabilidad
    public int $spd; // velocidad punta

    /**
     * Constructor del coche
     */
    public function __construct(
        string $name,
        string $brand,
        string $decade,
        string $tier,
        int $pwr,
        int $grp,
        int $hnd,
        int $trc,
        int $spd
    ) {
        $this->name = $name;
        $this->brand = $brand;
        $this->decade = $decade;
        $this->tier = $tier;

        $this->pwr = $pwr;
        $this->grp = $grp;
        $this->hnd = $hnd;
        $this->trc = $trc;
        $this->spd = $spd;
    }

    /**
     * 🔥 Devuelve todas las stats como array (para simulator)
     */
    public function getStats(): array {

        return [
            "pwr" => $this->pwr,
            "grp" => $this->grp,
            "hnd" => $this->hnd,
            "trc" => $this->trc,
            "spd" => $this->spd,
        ];
    }

    /**
     * 📊 cálculo rápido de “power rating” global (opcional pero útil)
     */
    public function getPowerScore(): float {

        return (
            $this->pwr +
            $this->grp +
            $this->hnd +
            $this->trc +
            $this->spd
        ) / 5;
    }
}