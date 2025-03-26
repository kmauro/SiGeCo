<?php

class AdminController{

    public function logInC(){
        if(isset($_POST["userI"])){
            $dataC = array("user"=>$_POST["userI"], "pass"=>$_POST["passI"]);

            $dbTable = "users";

            $answer = AdminModel::logInM($dataC, $dbTable);
            if(isset($answer["user"])){
                if($answer["user"] == $_POST["userI"] && $answer["pass"] == $_POST["passI"] ){

                    session_start();
                    $_SESSION["logged"] = true;
                    $_SESSION["access_level"] = $answer["id_access_level"];
    
                    header("location:index.php?route=dashboard");
                }else{
                    echo " ERROR AL INGRESAR, DATOS INCORRECTOS ";
                }
            }else{
                echo " ERROR AL INGRESAR, ESE USUARIO NO EXISTE ";
            }
            


        }
    }

}

?>