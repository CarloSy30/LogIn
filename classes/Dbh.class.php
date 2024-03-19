<?php

class Dbh{
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $dbName = "real_login";

    protected function connect(){
        try{
            $dsa = 'mysql:host=' .$this->host. ';dbname=' . $this->dbName;
            $pdo = new PDO($dsa, $this->user, $this->password);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        }catch(PDOException $e){
            echo $e->getMessage();
            die();
        }
    }
    
}