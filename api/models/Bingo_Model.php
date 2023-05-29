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

    public function GetGameSession($game_sessions)
    {
        $Get = "SELECT * FROM tbl_game_sessions WHERE game_sessions=:game_sessions";
        $Get = $this->DB->prepare($Get);
        $Get->execute([
            ":game_sessions" => $game_sessions,
        ]);
        return $Get->fetchAll(\PDO::FETCH_OBJ);
    }

    public function SetGameSessionEnd($game_sessions)
    {
        $Set = "UPDATE tbl_game_sessions SET is_game_ended = 1 WHERE game_sessions=:game_sessions";
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


    public function SetCardNumberMarked($letter, $number)
    {
        $Set = "UPDATE tbl_cards set is_marked=1 WHERE letter=:letter AND number=:number";
        $Set = $this->DB->prepare($Set);
        $Set->execute([
            ":letter" => $letter,
            ":number" => $number,
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

    public function CheckBingoNumberIfExists($game_sessions, $letter, $number)
    {
        $Get = "SELECT * FROM tbl_bingo_numbers WHERE game_sessions =:game_sessions AND letter =:letter AND number =:number";
        $Get = $this->DB->prepare($Get);
        $Get->execute([
            ":game_sessions" => $game_sessions,
            ":letter" => $letter,
            ":number" => $number,
        ]);
        return $Get;
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

    public function CheckBingoNumber($game_sessions, $letter, $number)
    {
        $Get = "SELECT * FROM tbl_bingo_numbers WHERE game_sessions=:game_sessions AND letter=:letter AND number=:number";
        $Get = $this->DB->prepare($Get);
        $Get->execute([
            ":game_sessions" => $game_sessions,
            ":letter" => $letter,
            ":number" => $number,
        ]);
        return $Get;
    }

    public function CheckHorizontalBingo($game_sessions)
    {
        $Get = "SELECT COUNT(*) as CNT, row FROM tbl_cards WHERE game_sessions=:game_sessions and is_marked=1 GROUP BY row HAVING CNT>=5";
        $Get = $this->DB->prepare($Get);
        $Get->execute([
            ":game_sessions" => $game_sessions,
        ]);
        return $Get;
    }
    public function CheckVerticalBingo($game_sessions)
    {
        $Get = "SELECT COUNT(*) as CNT, letter FROM tbl_cards WHERE game_sessions=:game_sessions and is_marked=1 GROUP BY letter HAVING CNT>=5";
        $Get = $this->DB->prepare($Get);
        $Get->execute([
            ":game_sessions" => $game_sessions,
        ]);
        return $Get;
    }


    public function CheckDiagonalBingo($game_sessions, $where)
    {
        $Get = "SELECT COUNT(*) AS CNT FROM tbl_cards WHERE game_sessions=:game_sessions AND is_marked=1 AND ( {$where} );";
        $Get = $this->DB->prepare($Get);
        $Get->execute([
            ":game_sessions" => $game_sessions,
        ]);
        return $Get->fetchAll(\PDO::FETCH_OBJ)[0]->CNT;
    }

    public function GetAllGameSessions()
    {
        $Get = "SELECT * FROM tbl_game_sessions ORDER BY id DESC";
        $Get = $this->DB->prepare($Get);
        $Get->execute();
        return $Get->fetchAll(\PDO::FETCH_OBJ);
    }

}
