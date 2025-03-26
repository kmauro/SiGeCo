<?php

class RouteController{
    public function template(){
        include "Views/template.php";
    }

    public function login(){
        include "Views/login.php";
    }


    public function routes(){

        if(isset($_GET["route"])){
            $routes = $_GET["route"];
        }else{
            $routes = "index";
        }

        $answer = Model::RouteModel($routes);


        include $answer;
    }
}

?>