<?php
require_once "config.php";
class AdminModel{
    static public function logInM($dataC, $dbTable){
        $sql = "SELECT user, password AS contra, id_access_level FROM $dbTable WHERE user = :usuario";
        $pdo = Config::cnx()->prepare($sql);
        $pdo->bindParam(":usuario", $dataC["user"], PDO::PARAM_STR);
        $pdo->execute();
        $user = $pdo->fetch();
        if(!empty($user)){
            if(password_verify($dataC["pass"], $user["contra"])){
                return $user;
            }else{
                return "error contraseña";
            }
        }else{
            return "error usuario";
        }
        $pdo->close();

    }

    static public function addUserM($dbTable, $regData){
        $sql = "INSERT INTO $dbTable (user, password, id_access_level, name, email, phone_number) VALUES (:user, :password, :id_access_level, :name, :email, :phone_number)";
        $pdo = Config::cnx()->prepare($sql);
        $pdo->bindParam(":user", $regData["user"], PDO::PARAM_STR);
        $pdo->bindParam(":password", password_hash($regData["password"], PASSWORD_DEFAULT), PDO::PARAM_STR);
        $pdo->bindParam(":id_access_level", $regData["access_level"], PDO::PARAM_INT);
        $pdo->bindParam(":name", $regData["name"], PDO::PARAM_STR);
        $pdo->bindParam(":email", $regData["email"], PDO::PARAM_STR);
        $pdo->bindParam(":phone_number", $regData["phone_number"], PDO::PARAM_STR);

        if($pdo->execute()){
            return 1;
        }else{
            return "error";
        }
        $pdo->close();
    }
}

?>