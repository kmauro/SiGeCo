<?php

require_once "config.php";

class StockModel{

    public static function showStockM($dbTable, $dataID){
        $sql = "SELECT products.id, products.name, categories.category, subcategories.subcategory, cost, price, quantity, desired_quantity FROM $dbTable INNER JOIN subcategories ON products.id_subcategory = subcategories.id INNER JOIN categories ON subcategories.id_Category = categories.id";
        if($dataID != 0){
            $sql = $sql + " WHERE products.id_subcategory = :subcategoryid;";
        }
        $pdo = Config::cnx()->prepare($sql);
        if($dataID != 0){
            $pdo->bindParam(":subcategoryid", $dataID, PDO::PARAM_INT);
        }
        $pdo->execute();

        return $pdo->fetchAll();

        $pdo->close();
    }

    public static function addProductM($dbTable, $regData, $suppliers){
        try {


            $pdo = new PDO("mysql:host=localhost;dbname=sigeco", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            // Insertar producto
            $stmt = $pdo->prepare("INSERT INTO $dbTable (name, id_subcategory, cost, price, quantity, desired_quantity) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$regData["name"], $regData["subcategory_id"], $regData["cost"], $regData["price"], $regData["quantity"], $regData["d_quantity"]]);
            echo "todo ok";
            $productId = $pdo->lastInsertId();
            //REFACTOR THIS
            //array de producto->proveedores
            $query = "INSERT INTO supplier_product (id_supplier, id_product) VALUES ";
            

            foreach($suppliers as $key => $value /* por cada proveedor seleccionado */){
                $query = $query."($value, $productId),";
            }
            $query = substr($query,0,-1);
            $query=$query.';';
            $stmt = $pdo->prepare($query);
            if($stmt->execute()){
                return 1;
            }else{
                return 0;
            }
            
            $stmt->close();
        } catch (PDOException $e) {
            echo "Error al agregar producto: " . $e->getMessage();
        }
    }


}

?>
