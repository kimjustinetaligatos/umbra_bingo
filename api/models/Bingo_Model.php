<?php
include_once "../config/Database.php";

class Bingo_Model
{

    protected $DB;

    public function __construct()
    {
        $database = new Database();
        $this->DB = $database->Connect();
    }

    public function SetGameSession($game_sessions)
    {
        $Set = "INSERT into tbl_game_sessions(game_sessions) values(:game_sessions)";
        $Set = $this->DB->prepare($Set);
        $Set->execute([
            ":game_sessions" => $game_sessions,
        ]);
        return $Set;
    }

    public function GetCard($game_sessions)
    {
        $Get = "SELECT * FROM tbl_cards WHERE game_sessions=:game_sessions ORDER BY row ASC";
        $Get = $this->DB->prepare($Get);
        $Get->execute([
            ":game_sessions" => $game_sessions,
        ]);
        return $Get->fetchAll(\PDO::FETCH_OBJ);
    }

    public function SetCard($game_sessions, $GeneratedBingoCardArr)
    {
        $sql = "INSERT INTO tbl_cards (game_sessions, letter, number, row) VALUES (:game_sessions, :letter, :number, :row)";
        $stmt = $this->DB->prepare($sql);
        foreach ($GeneratedBingoCardArr as $key => $item) {
            $i = 1;
            foreach ($item as $itemNumbers) {
                $stmt->execute([
                    ':game_sessions' => $game_sessions,
                    ':letter' => $key,
                    ':number' => $itemNumbers,
                    ':row' => $i,
                ]);

                $i++;
            }

        }
        return $stmt;
    }

    public function SetBingoNumber($game_sessions, $letter, $number)
    {
        $Set = "INSERT into tbl_bingo_numbers(game_sessions,letter,number) values(:game_sessions,:letter,:number)";
        $Set = $this->DB->prepare($Set);
        $Set->execute([
            ":game_sessions" => $game_sessions,
            ":letter" => $letter,
            ":number" => $number,
        ]);
        return $Set;
    }

    public function GetBingoNumbers($game_sessions)
    {
        $Get = "SELECT * FROM tbl_bingo_numbers WHERE game_sessions=:game_sessions ORDER BY id DESC";
        $Get = $this->DB->prepare($Get);
        $Get->execute([
            ":game_sessions" => $game_sessions,
        ]);
        return $Get->fetchAll(\PDO::FETCH_OBJ);
    }


}
