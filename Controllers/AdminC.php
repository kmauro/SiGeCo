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
            $regData = array("user"=>$_POST["user"], "password"=>$_POST["password"], "access_level"=>$_POST["accessLevel"], "name"=>$_POST["address"], "email"=>$_POST["email"], "phone_number"=>$_POST["phone"]);
            $answer = AdminModel::addUserM($dbTable, $regData);
            if($answer == 1){
                header("location:index.php?route=users");
            }else{
                echo "error";
            }
        }
    }

}

?>