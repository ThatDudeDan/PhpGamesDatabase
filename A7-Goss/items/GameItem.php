<?php

class GameItem implements JsonSerializable {
    
    private $gameID;
    private $title;
    private $genre;
    private $company;
    private $releaseDate;
    private $playerNum;
    
    public function __construct($inGameId, $inTitle, $inGenre, $inCompany, $inReleaseDate, $inPlayerNum) {
        $this->gameID = $inGameId;
        $this->title = $inTitle;
        $this->genre = $inGenre;
        $this->releaseDate = $inReleaseDate;
        $this->company = $inCompany;
        $this->playerNum = $inPlayerNum;
    }
    
    public function getGameID () {
        return $this->gameID;
    }
    
    public function getTitle () {
        return $this->title;
    }
    
    public function getCompany () {
        return $this->company;
    }
    
    public function getGenre () {
        return $this->genre;
    }    
    
    public function getReleaseDate () {
        return $this->releaseDate;
    }
    
    public function getPlayerNum () {
        return $this->playerNum;
    }    
    
    public function jsonSerialize() {
        return get_object_vars($this);
    }

}

