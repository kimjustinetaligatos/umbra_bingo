<?php
session_start();

if(isset($_SESSION["GAMESESSION"])){
    $GameSession = $_SESSION["GAMESESSION"];
}else{
    $GameSession = null;
}

echo json_encode(["ErrorCode"=>0, "ErrorMessage" => "Success", "Records" => ["GameSession" => $GameSession]]);
exit();