
<?php

class Model{
    static public function RouteModel($route){

        if($route == "stock" || $route == "deleteProduct" || $route == "deleteSupplier" || $route == "register" || $route == "supplier"|| $route == "exit" || $route == "dashboard" || $route =="profile" || $route == "suppliers" || $route == "product" || $route == "get_data"){
            $page = "Views/modules/".$route.".php";
        }else{
            $page = "Views/modules/dashboard.php";
        }

        return $page;

    }
}