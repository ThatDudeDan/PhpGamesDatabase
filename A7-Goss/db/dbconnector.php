<?php


class dbconnector {
    public function db_Connect() {
    $db = new PDO("mysql:host=localhost;dbname=gamesdb", "Daniel", "Xds8w2yh!123");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // throw exceptions
    return $db;
}
}
