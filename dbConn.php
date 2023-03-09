<?php

class Database{

    public static $connection;
    public static function setConnection(){

        if(!isset(Database::$connection)){
            Database::$connection=new mysqli("localhost","root","###########","eshop","3308");
        }
    }

    // for inu insert update delete
    public static function iud($q){
        Database::setConnection();
        $rs = Database::$connection->query($q);
        return $rs;
    }

    //for search
    public static function search($q){
        Database::setConnection();
        $resultSet = Database::$connection->query($q);
        return $resultSet;
    }
}




?>