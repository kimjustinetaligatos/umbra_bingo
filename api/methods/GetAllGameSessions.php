<?php
session_start();
include_once  "../config/Helpers.php";
include_once  "../models/Bingo_Model.php";
$Bingo_Model = new Bingo_Model();

$GetALlGameSessions = $Bingo_Model->GetAllGameSessions();

echo json_encode(["ErrorCode"=>0, "ErrorMessage" => "Success", "Records" => ["GameSessions" => $GetALlGameSessions]]);
exit();