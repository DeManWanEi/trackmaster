<?php

class Race
{
    private array $cars;
    private Track $track;
    private Simulator $sim;

    public function __construct(
        array $cars,
        Track $track,
        Simulator $sim
    ) {
        $this->cars = $cars;
        $this->track = $track;
        $this->sim = $sim;
    }

    public function run(): array
    {
        $results = [];

        foreach ($this->cars as $car) {

            $performance = $this->sim->simulate($car, $this->track);

            $time = (
                ($this->track->length / $performance)
                * $this->track->timeFactor
                * 0.1
            );

            $results[] = [
                "car" => $car,
                "time" => $time
            ];
        }

        usort(
            $results,
            fn($a, $b) => $a["time"] <=> $b["time"]
        );

        return $results;
    }
}