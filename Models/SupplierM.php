<?php

class SupplierModel{

    static public function showSupplierM($dbTable, $dataID){
        if($dataID != 0){
            $sql = "SELECT * FROM $dbTable INNER JOIN supplier_product ON suppliers.id = supplier_product.id_supplier WHERE supplier_product.id_product = :idProd";
            
        }else{
            $sql = "SELECT * FROM $dbTable";
        }
        $pdo = Config::cnx()->prepare($sql);
        if($dataID != 0) {
             $pdo->bindParam(":idProd", $dataID, PDO::PARAM_INT);
        }

        $pdo->execute();

        return $pdo->fetchAll();

        $pdo->close();
    }


    static public function addSupplierM($dbTable, $regData){
        $sql = "INSERT INTO $dbTable (name, cuit, phone_number, email, address) VALUES (:name, :cuit, :phone_number, :email, :address)";
        $pdo = Config::cnx()->prepare($sql);
        $pdo->bindParam(":name", $regData["name"], PDO::PARAM_STR);
        $pdo->bindParam(":cuit", $regData["cuit"], PDO::PARAM_STR);
        $pdo->bindParam(":phone_number", $regData["phone_number"], PDO::PARAM_STR);
        $pdo->bindParam(":email", $regData["email"], PDO::PARAM_STR);
        $pdo->bindParam(":address", $regData["address"], PDO::PARAM_STR);

        if($pdo->execute()){
            return "success";
        }else{
            return "error";
        }

        $pdo->close();
    }
    
}

?>