<?php

class Car {
    public string $name;

    /*
     * STATS BASE DEL COCHE (0 - 100)
     *
     * pwr = Power (Potencia del motor)
     * grp = Grip (Agarre lateral en curva)
     * hnd = Handling (Control / precisión de dirección)
     * trc = Traction (Tracción, salida de curva / tierra / lluvia)
     * spd = Speed (Velocidad punta en recta)
     * rel = Reliability (Fiabilidad / consistencia)
     */

    public int $pwr;
    public int $grp;
    public int $hnd;
    public int $trc;
    public int $spd;

    public function __construct(
        string $name,
        int $pwr,
        int $grp,
        int $hnd,
        int $trc,
        int $spd,
    )
    {
        $this->name = $name;
        $this->pwr = $pwr;
        $this->grp = $grp;
        $this->hnd = $hnd;
        $this->trc = $trc;
        $this->spd = $spd;
    }
}