<?php

class SupplierModel{

    static public function showSupplierM($dbTable, $dataID){
        $sql = "SELECT id, name, cuit, phone_number, email, address FROM $dbTable";
        if($dataID != 0){
            $sql = $sql." WHERE id = :id";
        }
        $pdo = Config::cnx()->prepare($sql);
        if($dataID != 0) {
             $pdo->bindParam(":id", $dataID, PDO::PARAM_INT);
        }

        $pdo->execute();
        if($dataID != 0){
            $answer = $pdo->fetch();
        }else{
            $answer = $pdo->fetchAll();
        }
        
        return $answer;

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

    public static function editSupplierM($dbTable, $regData, $dataID){
        $sql = "UPDATE $dbTable SET name = :name, cuit = :cuit, phone_number = :phone_number, email = :email, address = :address WHERE id = :id";
        $pdo = Config::cnx()->prepare($sql);
        $pdo->bindParam(":name", $regData["name"], PDO::PARAM_STR);
        $pdo->bindParam(":cuit", $regData["cuit"], PDO::PARAM_STR);
        $pdo->bindParam(":phone_number", $regData["phone_number"], PDO::PARAM_STR);
        $pdo->bindParam(":email", $regData["email"], PDO::PARAM_STR);
        $pdo->bindParam(":address", $regData["address"], PDO::PARAM_STR);
        $pdo->bindParam(":id", $dataID, PDO::PARAM_INT);

        if($pdo->execute()){
            return "success";
        }else{
            return "error";
        }

        $pdo->close();
    }


    public static function deleteSupplierM($dbTable, $dataID){
        $sql = "DELETE FROM supplier_product WHERE id_supplier = :id";
        $pdo = Config::cnx()->prepare($sql);
        $pdo->bindParam(":id", $dataID, PDO::PARAM_INT);
        $pdo->execute();
        $sql = "DELETE FROM $dbTable WHERE id = :id";
        $pdo = Config::cnx()->prepare($sql);
        $pdo->bindParam(":id", $dataID, PDO::PARAM_INT);

        if($pdo->execute()){
            return "success";
        }else{
            return "error";
        }

        $pdo->close();
    }
    
}

?>