<?php
session_start();
include_once  "../config/Helpers.php";
include_once  "../models/Bingo_Model.php";
$Bingo_Model = new Bingo_Model();


$GetBingoNumbers = $Bingo_Model->GetBingoNumbers($_SESSION["GAMESESSION"]);


echo json_encode(["ErrorCode"=>0, "ErrorMessage" => "Success", "Records" => ["BingoNumbers" => $GetBingoNumbers]]);
exit();