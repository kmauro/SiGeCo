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
                    <td><a href="index.php?route=suppliers&id='.$value["id"].'"<button>Editar</button></a></td>
                    <td><a href="index.php?route=suppliers&id='.$value["id"].'"<button>Borrar</button></a></td>
                    
            </tr>';
        }
    }
}


?> 