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
$GetGameSessionInfo = $Bingo_Model->GetGameSession($GameSession);

$GeneratedBingoCardArr = [];
$BingoCardSettings = $Helpers->GetBingoCardSettings();
foreach($BingoCardSettings as $key => $bingoCardSetting){
    $GeneratedBingoCardArr[$key] = [];
}

$MarkedCardNumbersArr = [];

foreach ($GetCard as $GetCardValues){
    array_push($GeneratedBingoCardArr[$GetCardValues->letter], $GetCardValues->number);

    if($GetCardValues->is_marked == 1){
        array_push($MarkedCardNumbersArr, $GetCardValues->letter . "" . $GetCardValues->number);
    }

}


echo json_encode([
    "ErrorCode"=>0,
    "ErrorMessage" => "Success",
    "Records" => [
        "GameSession" => $GameSession,
        "PlayerCard" => $GeneratedBingoCardArr,
        "MarkedCardNumbersArr" => $MarkedCardNumbersArr,
        "GetGameSessionInfo" => $GetGameSessionInfo[0],
    ]]);
exit();