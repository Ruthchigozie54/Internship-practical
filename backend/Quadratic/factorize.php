<?php

/**
 * Calculates the discriminant (b² - 4ac)
 */
function calculateDiscriminant($a, $b, $c)
{
    return ($b * $b) - (4 * $a * $c);
}

/**
 * Solves a quadratic equation using the quadratic formula.
 */
function solveQuadratic($a, $b, $c)
{
    $d = calculateDiscriminant($a, $b, $c);

    if ($d > 0) {

        $root1 = (-$b + sqrt($d)) / (2 * $a);
        $root2 = (-$b - sqrt($d)) / (2 * $a);

        return [
            "success" => true,
            "type" => "real roots",
            "root1" => $root1,
            "root2" => $root2
        ];
    }

    if ($d == 0) {

        $root = -$b / (2 * $a);

        return [
            "success" => true,
            "type" => "repeated root",
            "root" => $root
        ];
    }

    $real = -$b / (2 * $a);
    $imaginary = sqrt(abs($d)) / (2 * $a);

    return [
        "success" => true,
        "type" => "complex roots",
        "root1" => "{$real} + {$imaginary}i",
        "root2" => "{$real} - {$imaginary}i"
    ];
}

/**
 * Attempts to factorize using integer factors.
 */
function factorEquation($a, $b, $c)
{

    $factorA = [];
    $factorC = [];

    for ($i = 1; $i <= abs($a); $i++) {

        if ($a % $i == 0) {

            $factorA[] = $i;
            $factorA[] = -$i;

        }

    }

    for ($i = 1; $i <= abs($c); $i++) {

        if ($c % $i == 0) {

            $factorC[] = $i;
            $factorC[] = -$i;

        }

    }

    foreach ($factorA as $m) {

        foreach ($factorA as $p) {

            if ($m * $p != $a)
                continue;

            foreach ($factorC as $n) {

                foreach ($factorC as $q) {

                    if ($n * $q != $c)
                        continue;

                    if (($m * $q) + ($n * $p) == $b) {

                        return [

                            "success" => true,

                            "type" => "factorized",

                            "factorized" => formatFactor($m, $n) . formatFactor($p, $q)

                        ];

                    }

                }

            }

        }

    }

    return false;

}

/**
 * Formats factors nicely.
 */
function formatFactor($coefficient, $constant)
{

    $text = "(";

    if ($coefficient == 1)
        $text .= "x";
    elseif ($coefficient == -1)
        $text .= "-x";
    else
        $text .= "{$coefficient}x";

    if ($constant > 0)
        $text .= " + {$constant}";

    if ($constant < 0)
        $text .= " - " . abs($constant);

    $text .= ")";

    return $text;

}

/**
 * Main function
 */
function factorizeQuadratic($a, $b, $c)
{

    if ($a == 0) {

        return [

            "success" => false,

            "message" => "Not a quadratic equation."

        ];

    }

    $factor = factorEquation($a, $b, $c);

    if ($factor) {

        return $factor;

    }

    return solveQuadratic($a, $b, $c);

}