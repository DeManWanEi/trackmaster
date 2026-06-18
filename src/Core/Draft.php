<?php

class Draft {

    public static function rollBrand(array $cars): string {

        $brands = array_unique(array_map(fn($c) => $c->brand, $cars));

        return $brands[array_rand($brands)];
    }

    public static function rollDecade(array $cars, string $brand): string {

        $filtered = array_filter($cars, fn($c) => $c->brand === $brand);

        $decades = array_unique(array_map(fn($c) => $c->decade, $filtered));

        return $decades[array_rand($decades)];
    }

    public static function getDraft(array $cars, string $brand, string $decade): array {

        $pool = array_filter($cars, fn($c) =>
            $c->brand === $brand && $c->decade === $decade
        );

        $pool = array_values($pool);
        shuffle($pool);

        return array_slice($pool, 0, 5);
    }
}