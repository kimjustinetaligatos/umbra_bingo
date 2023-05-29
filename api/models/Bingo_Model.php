<?php
include_once "../config/Database.php";

class Bingo_Model
{

    protected $DB;
    protected $helpers;

    public function __construct()
    {
        $database = new Database();
        $this->DB = $database->Connect();

        $this->helpers = new Helpers();

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
        //$stmt->execute();
        return $stmt;


    }


}
