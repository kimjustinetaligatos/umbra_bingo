<?php
session_start();
include_once  "../config/Helpers.php";
include_once  "../models/Bingo_Model.php";
$Helpers = new Helpers();
$Bingo_Model = new Bingo_Model();

if(isset($_SESSION["GAMESESSION"])){
    $GameSession = $_SESSION["GAMESESSION"];
}else{
    $GameSession = null;
}

$GetCard = $Bingo_Model->GetCard($GameSession);

$GeneratedBingoCardArr = [];
$BingoCardSettings = $Helpers->GetBingoCardSettings();
foreach($BingoCardSettings as $key => $bingoCardSetting){
    $GeneratedBingoCardArr[$key] = [];
}

foreach ($GetCard as $GetCardValues){
    array_push($GeneratedBingoCardArr[$GetCardValues->letter], $GetCardValues->number);
}

echo json_encode(["ErrorCode"=>0, "ErrorMessage" => "Success", "Records" => ["GameSession" => $GameSession, "PlayerCard" => $GeneratedBingoCardArr]]);
exit();