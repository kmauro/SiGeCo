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
    
}

?>