<?php
session_start();
include_once  "../config/Helpers.php";
include_once  "../models/Bingo_Model.php";
$Helpers = new Helpers();
$Bingo_Model = new Bingo_Model();

$BingoCardSettings = $Helpers->GetBingoCardSettings();

$RandomLetter = array_rand($BingoCardSettings, 1);

$RandomNumber = $Helpers->UniqueRandomNumbersWithinRange($BingoCardSettings[$RandomLetter][0], $BingoCardSettings[$RandomLetter][1], 1);

$SetBingoNumber = $Bingo_Model->SetBingoNumber($_SESSION["GAMESESSION"], $RandomLetter, $RandomNumber[0]);

if($SetBingoNumber->rowCount() < 1)
{
    echo json_encode(["ErrorCode"=>1, "ErrorMessage" => "Unable to save bingo number"]);
    exit();
}

$GetBingoNumbers = $Bingo_Model->GetBingoNumbers($_SESSION["GAMESESSION"]);


echo json_encode(["ErrorCode"=>0, "ErrorMessage" => "Success", "Records" => ["BingoNumbers" => $GetBingoNumbers]]);
exit();