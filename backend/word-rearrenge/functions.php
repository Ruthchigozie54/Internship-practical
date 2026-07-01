<?php

function factorial($number)
{
    $result = 1;

    for ($i = 1; $i <= $number; $i++) {
        $result *= $i;
    }

    return $result;
}

function cleanWord($word)
{
    $word = trim($word);

    $word = strtoupper($word);

    $word = str_replace(" ", "", $word);

    return $word;
}

function getLetterFrequency($word)
{
    $letters = str_split($word);

    return array_count_values($letters);
}