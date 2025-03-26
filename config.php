<?php 

class Config{
    static public function cnx(){
        $db = new PDO("mysql:host=localhost;dbname=sigeco", "root", "");

        return $db;
    }
}


?>