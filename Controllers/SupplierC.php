<?php 

class SupplierController{
    public static function showSupplierC(){
        
        $dbTable="suppliers";
        if(!empty($_GET["id"])){
            $dataID = $_GET["id"];
        }else{
            $dataID = 0;
        }
        $answer = SupplierModel::showSupplierM($dbTable, $dataID);


        foreach($answer as $key => $value){
            echo '<tr>
                    <td>'.$value["name"].'</td>
                    <td>'.$value["cuit"].'</td>
                    <td>'.$value["phone_number"].'</td>
                    <td>'.$value["email"].'</td>
                    <td>'.$value["address"].'</td>
                    <td><a href="index.php?route=supplier&id='.$value["id"].'"<button>Editar</button></a></td>
                    <td><a href="index.php?route=supplier&id='.$value["id"].'"<button>Borrar</button></a></td>
                    
            </tr>';
        }
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
}


?> 