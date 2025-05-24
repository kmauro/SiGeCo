<?php

class AdminController{

    public function logInC(){
        if(!empty($_POST["userI"])){
            $dataC = array("user"=>$_POST["userI"], "pass"=>$_POST["passI"]);

            $dbTable = "users";

            $answer = AdminModel::logInM($dataC, $dbTable);
            
            if(is_array($answer)){
                    session_start();
                    $_SESSION["logged"] = true;
                    $_SESSION["access_level"] = $answer["id_access_level"];
                    $_SESSION["user"] = $answer["user"];
                    $_SESSION["id"] = $answer["id"];
                    header("location:index.php?route=dashboard");
            }else{
                echo $answer;
            }
            


        }
    }

    public function logOutC(){
        session_start();
        session_destroy();
        header("location:index.php?route=login");
    }

    public function addUserC(){
        if(!empty($_POST["user"]) && !empty($_POST["password"]) && !empty($_POST["accessLevel"])){
            $dbTable = "users";
            $regData = array("user"=>$_POST["user"], "password"=>$_POST["password"], "access_level"=>$_POST["accessLevel"], "name"=>$_POST["name"], "email"=>$_POST["email"], "phone_number"=>$_POST["phone"]);
            $answer = AdminModel::addUserM($dbTable, $regData);
            if($answer == 1){
                header("location:index.php?route=users");
            }else{
                echo "error";
            }
        }
    }

    public function showUsersC(){
        $dbTable = "users";
        $answer = AdminModel::showUsersM($dbTable);
        foreach($answer as $value){
            echo '<tr>';
            echo '<td>'.$value["user"].'</td>';
            echo '<td>'.$value["name"].'</td>';
            echo '<td>'.$value["access_level"].'</td>';
            echo '<td>'.$value["phone_number"].'</td>';
            echo '<td>'.$value["email"].'</td>';
            echo '<td><a href="index.php?route=user&id='.$value["id"].'"<button>Editar    </button></a>';
            
            if($_SESSION["user"] != $value["user"]){   
                echo '<a href="index.php?route=deleteUser&id='.$value["id"].'"<button>Eliminar</button></a>';
            }
            echo '</td>';
            echo '</tr>';
        }
        

        
    }

    public function showUserC($dataID){
        $dbTable = "users";
        $answer = AdminModel::showUserM($dbTable, $dataID);
        return $answer;
    }

    public function editUserC($dataID){
        if(!empty($dataID)){
            $dbTable = "users";
            $regData = array(
                "name"=>$_POST["name"],
                "email"=>$_POST["email"],
                "phone_number"=>$_POST["phone"],
                "id"=>$dataID,
                "access_level"=>$_POST["accessLevel"]
            );
            $answer = AdminModel::editUserM($dbTable, $regData);
            if($answer == 1){
                header("location:index.php?route=users");
            }else{
                echo "error";
                header("location:index.php?route=dashboard");
            }
        }
    }

    public function deleteUserC($dataID){
        $dbTable = "users";
        $answer = AdminModel::deleteUserM($dbTable, $dataID);
        if($answer == 1){
            header("location:index.php?route=users");
        }else{
            echo "error";
        }
    }

    public function changePasswordC(){
        if(!empty($_POST["password"]) && !empty($_POST["newPassword"]) && !empty($_POST["confirmPassword"])){
            $dbTable = "users";
            $regData = array("password"=>$_POST["password"], "newPassword"=>$_POST["newPassword"], "confirmPassword"=>$_POST["confirmPassword"], "id"=>$_SESSION["id"]);
            $answer = AdminModel::changePasswordM($dbTable, $regData);
            if($answer == 1){
                header("location:index.php?route=dashboard");
            }else{
                echo $answer;
            }
        }
    }


    public function getAccessLevelC(){
        $dbTable = "access_levels";
        $answer = AdminModel::getAccessLevelM($dbTable);
        return $answer;
    }
}

?>