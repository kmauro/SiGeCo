<?php
require_once "config.php";
class AdminModel{
    static public function logInM($dataC, $dbTable){

        //$pdo = Config::cnx()->prepare("SELECT user, pass AS contra FROM $dbTable WHERE user = ?");
        //$pdo->bindParam(":usuario", $datosC["usuario"], PDO::PARAM_STR);
        //$pdo->execute($datosC);
        //return $pdo->fetch();
        //$pdo-> close();
        $pdo = new PDO("mysql:host=localhost;dbname=sigeco", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $pdo->prepare("SELECT user, password AS pass, id_access_level FROM $dbTable WHERE user = :user");
        $stmt->bindParam(":user", $dataC["user"], PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();


    }
}

?>