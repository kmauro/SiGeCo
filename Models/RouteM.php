
<?php

class Model{

    public static function RouteModel($route){

        if($route == "stock" || $route=="changePassword" || $route == "control" || $route=="users" || $route == "deleteProduct" || $route == "deleteSupplier" || $route=="deleteUser" || $route == "user" || $route == "supplier"|| $route == "exit" || $route == "dashboard" || $route =="profile" || $route == "suppliers" || $route == "product" || $route == "get_data"){
            $page = "Views/modules/".$route.".php";
        }else{
            $page = "Views/modules/dashboard.php";
        }

        return $page;

    }
    
}