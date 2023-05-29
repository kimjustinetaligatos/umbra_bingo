<?php

class Helpers
{

    public function GenerateString($length)
    {
        $characters = "0123456789";
        //$characters .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

        $string_generated = "";

        $nmr_loops = $length;
        while ($nmr_loops--) {
            $string_generated .= $characters[mt_rand(0, strlen($characters) - 1)];
        }

        return $string_generated;
    }

    public function UniqueRandomNumbersWithinRange($min, $max, $quantity)
    {
        $numbers = range($min, $max);
        shuffle($numbers);
        return array_slice($numbers, 0, $quantity);
    }

    public function GetBingoCardSettings()
    {
        return [
            "B" => [1,25],
            "I" => [26,40],
            "N" => [41,55],
            "G" => [56,70],
            "O" => [71,85]
        ];
    }
}
