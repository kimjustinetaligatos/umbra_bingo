<?php
session_start();
include_once  "../config/Helpers.php";
include_once  "../models/Bingo_Model.php";
$Helpers = new Helpers();
$Bingo_Model = new Bingo_Model();

$GameSession = $Helpers->GenerateString(10);

$SaveGameSession = $Bingo_Model->SetGameSession($GameSession);
if($SaveGameSession->rowCount() < 1)
{
    echo json_encode(["ErrorCode"=>1, "ErrorMessage" => "Unable to save game session"]);
    exit();
}

#GENERATE BINGO CARD
$GeneratedBingoCardArr = [];

$BingoCardSettings = $Helpers->GetBingoCardSettings();
foreach($BingoCardSettings as $key => $bingoCardSetting){
    $GeneratedBingoCardArr[$key] = $Helpers->UniqueRandomNumbersWithinRange($bingoCardSetting[0], $bingoCardSetting[1], 5);
}

$SetCard = $Bingo_Model->SetCard($GameSession, $GeneratedBingoCardArr);
if($SetCard->rowCount() < 1)
{
    echo json_encode(["ErrorCode"=>1, "ErrorMessage" => "Unable to save card details"]);
    exit();
}
#END GENERATE BINGO CARD

#SET SESSION IF GAME SUCCESSFULLY SAVED
$_SESSION["GAMESESSION"] = $GameSession;

echo json_encode(["ErrorCode"=>0, "ErrorMessage" => "Success", "Records" => ["GameSession" => $GameSession, "PlayerCard" => $GeneratedBingoCardArr]]);
exit();