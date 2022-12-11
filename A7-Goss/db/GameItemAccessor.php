<?php
$projectRoot = $_SERVER['DOCUMENT_ROOT'] . '/DGoss/A5-Goss';
require_once 'dbconnector.php';
require_once ($projectRoot . '/items/GameItem.php');
require '../ChromePhp.php';

class GameItemAccessor {
    private $getStatementString = "select * from game";
    private $deleteStatementString = "delete from game where gameID = :gameID";
    private $insertStatementString = "insert INTO game values (:gameID,:title,:genre,:company,:releaseDate,:playerNum)";
    private $updateStatementString = "update game set title = :title, genre = :genre, company = :company, releaseDate = :releaseDate, playerNum = :playerNum where gameID = :gameID";
    private $conn = NULL;
    private $getStatement = NULL;
    private $deleteStatement = NULL;
    private $insertStatement = NULL;
    private $updateStatement = NULL;

    public function __construct() {
        $connection = new dbconnector();

        $this->conn = $connection->db_Connect();
        if (is_null($this->conn)) {
            throw new Exception("no connection");
        }
        $this->getStatement = $this->conn->prepare($this->getStatementString);
        if (is_null($this->getStatement)) {
            throw new Exception("bad statement: '" . $this->getStatementString . "'");
        }

        $this->deleteStatement = $this->conn->prepare($this->deleteStatementString);
        if (is_null($this->deleteStatement)) {
            throw new Exception("bad statement: '" . $this->deleteStatementString . "'");
        }

        $this->insertStatement = $this->conn->prepare($this->insertStatementString);
        if (is_null($this->insertStatement)) {
            throw new Exception("bad statement: '" . $this->getAllStatementString . "'");
        }

        $this->updateStatement = $this->conn->prepare($this->updateStatementString);
        if (is_null($this->updateStatement)) {
            throw new Exception("bad statement: '" . $this->updateStatementString . "'");
        }
    }
            
    public function getAllGames() {
        $result = [];

        try {
            $this->getStatement->execute();
            $dbresults = $this->getStatement->fetchAll(PDO::FETCH_ASSOC);

            foreach ($dbresults as $res) {
                $gameID = $res['gameID'];
                $title = $res['title'];
                $genre = $res['genre'];
                $company = $res['company'];
                $realeaseDate = $res['releaseDate'];
                $playerNum = $res['playerNum'];
                $obj = new GameItem($gameID, $title, $genre, $company, $realeaseDate, $playerNum);
                array_push($result, $obj);
            }
        }
        catch (Exception $e) {
            $result = [];
        }
        finally {
            if (!is_null($this->getStatement)) {
                $this->getStatement->closeCursor();
            }
        }
        
        return $result;
    }

    public function deleteGame($game) {
        $success = false;

        $gameID = $game->getGameID(); 

        try {
            $this->deleteStatement->bindParam(":gameID", $gameID);
            $success = $this->deleteStatement->execute(); 
            $rc = $this->deleteStatement->rowCount();
        }
        catch (PDOException $e) {
            $success = false;
        }
        finally {
            if (!is_null($this->deleteStatement)) {
                $this->deleteStatement->closeCursor();
            }
        }
        return $success;
    }

        public function insertGame($game) {
        $success = false;

        $gameID = $game->getGameID();
        $title = $game->getTitle();
        $genre = $game->getGenre();
        $company = $game->getCompany();
        $releaseDate = $game->getReleaseDate();
        $playerNum = $game->getPlayerNum();

        try {
            $this->insertStatement->bindParam(":gameID", $gameID);
            $this->insertStatement->bindParam(":title", $title);
            $this->insertStatement->bindParam(":genre", $genre);
            $this->insertStatement->bindParam(":company", $company);
            $this->insertStatement->bindParam(":releaseDate", $releaseDate);
            $this->insertStatement->bindParam(":playerNum", $playerNum);
            $success = $this->insertStatement->execute();
        }
        catch (PDOException $e) {
            $success = false;
        }
        finally {
            if (!is_null($this->insertStatement)) {
                $this->insertStatement->closeCursor();
            }
            ChromePhp::log($success);
            return $success;
        }
    }
    
        public function updateGame($game) {
        $success = false;

        $gameID = $game->getGameID();
        $title = $game->getTitle();
        $genre = $game->getGenre();
        $company = $game->getCompany();
        $releaseDate = $game->getReleaseDate();
        $playerNum = $game->getPlayerNum();

        try {
            $this->updateStatement->bindParam(":gameID", $gameID);
            $this->updateStatement->bindParam(":title", $title);
            $this->updateStatement->bindParam(":genre", $genre);
            $this->updateStatement->bindParam(":company", $company);
            $this->updateStatement->bindParam(":releaseDate", $releaseDate);
            $this->updateStatement->bindParam(":playerNum", $playerNum);
            $success = $this->updateStatement->execute();
        }
        catch (PDOException $e) {
            $success = false;
        }
        finally {
            if (!is_null($this->updateStatement)) {
                $this->updateStatement->closeCursor();
            }
            return $success;
        }
    }
}

