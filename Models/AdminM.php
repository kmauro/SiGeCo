<?php
require_once "config.php";
class AdminModel{

    public static function logInM($dataC, $dbTable){
        $sql = "SELECT user, password AS contra, id_access_level, id FROM $dbTable WHERE user = :usuario";
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

    public static function addUserM($dbTable, $regData){
        $pHash = password_hash($regData["password"], PASSWORD_DEFAULT);
        $sql = "INSERT INTO $dbTable (user, password, id_access_level, name, email, phone_number) VALUES (:user, :password, :id_access_level, :name, :email, :phone_number)";
        $pdo = Config::cnx()->prepare($sql);
        $pdo->bindParam(":user", $regData["user"], PDO::PARAM_STR);
        $pdo->bindParam(":password", $pHash, PDO::PARAM_STR);
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

    public static function showUsersM($dbTable){
        $sql = "SELECT users.id, users.user, users.name, users.phone_number, users.email, access_levels.access_level FROM $dbTable INNER JOIN access_levels ON users.id_access_level = access_levels.id";
        $pdo = Config::cnx()->prepare($sql);
        $pdo->execute();
        return $pdo->fetchAll();
        $pdo->close();
    }

    public static function showUserM($dbTable, $dataID){
        $sql = "SELECT * FROM $dbTable WHERE id = :id_user";
        $pdo = Config::cnx()->prepare($sql);
        $pdo->bindParam(":id_user", $dataID, PDO::PARAM_INT);
        $pdo->execute();
        return $pdo->fetch();
        $pdo->close();
    }

    public static function editUserM($dbTable, $regData){
        $sql = "UPDATE $dbTable SET name = :name, email = :email, phone_number = :phone_number, id_access_level = :access_level WHERE id = :id";
        $pdo = Config::cnx()->prepare($sql);
        $pdo->bindParam(":name", $regData["name"], PDO::PARAM_STR);
        $pdo->bindParam(":email", $regData["email"], PDO::PARAM_STR);
        $pdo->bindParam(":phone_number", $regData["phone_number"], PDO::PARAM_STR);
        $pdo->bindParam(":id", $regData["id"], PDO::PARAM_INT);
        $pdo->bindParam(":access_level", $regData["access_level"], PDO::PARAM_INT);

        if($pdo->execute()){
            return 1;
        }else{
            return "error";
        }
        $pdo->close();
    }

    public static function deleteUserM($dbTable, $dataID){
        $sql = "DELETE FROM $dbTable WHERE id = :id";
        $pdo = Config::cnx()->prepare($sql);
        $pdo->bindParam(":id", $dataID, PDO::PARAM_INT);
        if($pdo->execute()){
            return 1;
        }else{
            return "error";
        }
        $pdo->close();
    }

    public static function changePasswordM($dbTable, $regData){
        $sql = "SELECT password FROM $dbTable WHERE id = :id";
        $pdo = Config::cnx()->prepare($sql);
        $pdo->bindParam(":id", $_SESSION["id"], PDO::PARAM_INT);
        $pdo->execute();
        $passHash = $pdo->fetch();
        if(!empty($passHash)){
            if(password_verify($regData["password"], $passHash["password"])){
                $sql = "UPDATE $dbTable SET password = :password WHERE id = :id";
                $pdo = Config::cnx()->prepare($sql);
                $pdo->bindParam(":password", password_hash($regData["newPassword"], PASSWORD_DEFAULT), PDO::PARAM_STR);
                $pdo->bindParam(":id", $_SESSION["id"], PDO::PARAM_INT);
                if($pdo->execute()){
                    return 1;
                }else{
                    return "error";
                }
                $pdo->close();
            }else{
                return "error contraseña";
            }
        }

        
        
    }

    public static function getAccessLevelM($dbTable){
        $sql = "SELECT * FROM $dbTable";
        $pdo = Config::cnx()->prepare($sql);
        $pdo->execute();
        return $pdo->fetchAll();
        $pdo->close();
    }
    
}

?>