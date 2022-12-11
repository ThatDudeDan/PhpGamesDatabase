<?php

$projectRoot = $_SERVER['DOCUMENT_ROOT'] . '/DGoss/A5-Goss';
require_once ($projectRoot . '/db/GameItemAccessor.php');
require_once ($projectRoot . '/items/GameItem.php');
require_once '../ChromePhp.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method === "GET") {
    doGet();
} else if ($method === "POST") {
    doPost();
} else if ($method === "DELETE") {
    doDelete();
} else if ($method === "PUT") {
    doPut();
}

function doGet() {
    // individual
    if (isset($_GET['gameid'])) { 
        // Individual gets not implemented.
        echo "Sorry, individual gets not allowed!";
    }
    // collection
    else {
        try {
            $gia = new GameItemAccessor();
            $res = $gia->getAllGames();
            $results = json_encode($res, JSON_NUMERIC_CHECK);
            echo $results;
        } catch (Exception $e) {
            echo "ERROR " . $e->getMessage();
        }
    }
}
function doDelete() {
    if (isset($_GET['gameid'])) { 
        $gameID = $_GET['gameid']; 

        $game = new GameItem($gameID,"","","","",0);

        // delete the object from DB
        $gia = new GameItemAccessor();
        $res = $gia->deleteGame($game);
        echo $res;
    } else {
        // Bulk deletes not implemented.
        echo ("Sorry, bulk deletes not allowed!");
    }
}

function doPost() {
    if (isset($_GET['gameid'])) { 
        // The details of the item to insert will be in the request body.
        $body = file_get_contents('php://input');
        $contents = json_decode($body, true);

        // create a MenuItem object
        $game = new GameItem($contents['gameID'], $contents['title'], $contents['genre'], $contents['company'], $contents['release'], $contents['players']);

        // add the object to DB
        $gia = new GameItemAccessor();
        $res = $gia->insertGame($game);
        echo $res;
    } else {
        // Bulk inserts not implemented.
        echo ("Sorry, bulk inserts not allowed!");
    }
}

function doPut() {
    if (isset($_GET['gameid'])) { 
        // The details of the item to insert will be in the request body.
        $body = file_get_contents('php://input');
        $contents = json_decode($body, true);

        // create a MenuItem object
        $game = new GameItem($contents['gameID'], $contents['title'], $contents['genre'], $contents['company'], $contents['release'], $contents['players']);

        // add the object to DB
        $gia = new GameItemAccessor();
        $res = $gia->updateGame($game);
        echo $res;
    } else {
        // Bulk inserts not implemented.
        echo ("Sorry, bulk inserts not allowed!");
    }
}
