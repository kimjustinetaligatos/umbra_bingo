<?php
session_start();
include_once  "../config/Helpers.php";
include_once  "../models/Bingo_Model.php";
$Helpers = new Helpers();
$Bingo_Model = new Bingo_Model();

#CHECK IF CURRENT BINGO NUMBER
$CheckBingoNumber = $Bingo_Model->CheckBingoNumber($_SESSION["GAMESESSION"], $_POST["letter"], $_POST["number"]);
$isBingo = 0;

if($CheckBingoNumber->rowCount() > 0)
{
    #SET NUMBER AS MARKED
    $SetCardNumberMarked = $Bingo_Model->SetCardNumberMarked($_POST["letter"], $_POST["number"]);
    if($SetCardNumberMarked->rowCount() < 1)
    {
        echo json_encode(["ErrorCode"=>1, "ErrorMessage" => "Unable to mark bingo number"]);
        exit();
    }
    else
    {
        #CHECK IF BINGO
        $CheckHorizontalBingo = $Bingo_Model->CheckHorizontalBingo($_SESSION["GAMESESSION"]);
        if($CheckHorizontalBingo->rowCount() > 0)
        {
           $isBingo = 1;
        }

        $CheckVerticalBingo = $Bingo_Model->CheckVerticalBingo($_SESSION["GAMESESSION"]);
        if($CheckVerticalBingo->rowCount() > 0)
        {
            $isBingo = 1;
        }

        $Diagonal1 = [
            "B" => 1,
            "I" => 2,
            "N" => 3,
            "G" => 4,
            "O" => 5,
        ];
        $WhereClause = $Helpers->GenerateWhereClause($Diagonal1);

        $CheckVerticalBingo = $Bingo_Model->CheckDiagonalBingo($_SESSION["GAMESESSION"], $WhereClause);
        if($CheckVerticalBingo >= 5)
        {
            $isBingo = 1;
        }

        $Diagonal2 = [
            "B" => 5,
            "I" => 4,
            "N" => 3,
            "G" => 2,
            "O" => 1,
        ];
        $WhereClause = $Helpers->GenerateWhereClause($Diagonal2);

        $CheckVerticalBingo = $Bingo_Model->CheckDiagonalBingo($_SESSION["GAMESESSION"], $WhereClause);
        if($CheckVerticalBingo >= 5)
        {
            $isBingo = 1;
        }

        #MARK GAME AS DONE
        if($isBingo){
            $SetGameSessionEnd = $Bingo_Model->SetGameSessionEnd($_SESSION["GAMESESSION"]);
            unset($_SESSION["GAMESESSION"]);
        }

        echo json_encode(["ErrorCode"=>0, "ErrorMessage" => "Success", "IsBingo" => $isBingo]);
        exit();
    }
}
else
{
    echo json_encode(["ErrorCode"=>1, "ErrorMessage" => "Not a Bingo number"]);
    exit();
}

