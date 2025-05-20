<?php 

class SupplierController{
    public static function showSupplierC($dataID = null){
        
        $dbTable="suppliers";
        if($dataID == null){
            $dataID = 0;
        }else{
            if(!empty($_GET["id"])){
                $dataID = $_GET["id"];
            }else{
                $dataID = 0;
            }
        }
        $answer = SupplierModel::showSupplierM($dbTable, $dataID);
        return $answer;
    }


    public static function addSupplierC(){
        if(!empty($_POST["name"])){
            $dbTable = "suppliers";
            $regData = array("name"=>$_POST["name"],
                                    "cuit"=>$_POST["cuit"],
                                    "phone_number"=>$_POST["phone"],
                                    "email"=>$_POST["email"],
                                    "address"=>$_POST["address"]);
            $answer = SupplierModel::addSupplierM($dbTable, $regData);
            if($answer == "success"){
                header("location:index.php?route=suppliers");
            }else{
                echo $answer;
            }
        }
    }

    public static function editSupplierC($dataID){
        if(!empty($_POST["name"])){
            $dbTable = "suppliers";
            $regData = array("name"=>$_POST["name"],
                                    "cuit"=>$_POST["cuit"],
                                    "phone_number"=>$_POST["phone"],
                                    "email"=>$_POST["email"],
                                    "address"=>$_POST["address"]);
            $answer = SupplierModel::editSupplierM($dbTable, $regData, $dataID);
            if($answer == "success"){
                header("location:index.php?route=suppliers");
            }else{
                echo $answer;
            }
        }
    }

    public static function deleteSupplierC($dataID){
        $dbTable = "suppliers";
        $answer = SupplierModel::deleteSupplierM($dbTable, $dataID);
        if($answer == "success"){
            header("location:index.php?route=suppliers");
        }else{
            echo $answer;
        }
    }


}


?> 