<?php

require_once "config.php";

class StockModel{

    public static function showStockM($dbTable, $dataID = null){
        $sql = "SELECT products.id, products.name, categories.category, subcategories.subcategory, cost, price, quantity, desired_quantity FROM $dbTable INNER JOIN subcategories ON products.id_subcategory = subcategories.id INNER JOIN categories ON subcategories.id_Category = categories.id";
        if(!empty($dataID)){
            $sql = $sql . " WHERE products.id_subcategory = :subcategoryid;";
        }
        $pdo = Config::cnx()->prepare($sql);
        if(!empty($dataID)){
            $pdo->bindParam(":subcategoryid", $dataID, PDO::PARAM_INT);
        }
        $pdo->execute();

        return $pdo->fetchAll();

        $pdo->close();
    }

    public static function showProductM($dbTable, $dataID){
        $sql = "SELECT p.name, p.cost, p.quantity, p.price, p.desired_quantity, categories.category, categories.id AS categoryID, subcategories.subcategory, subcategories.id AS subcategoryID FROM $dbTable AS p INNER JOIN subcategories ON p.id_subcategory = subcategories.id INNER JOIN categories ON subcategories.id_Category = categories.id  WHERE p.id = :id;";
        $pdo = Config::cnx()->prepare($sql);
        $pdo->bindParam(":id", $dataID, PDO::PARAM_INT);
        $pdo->execute();
        $product = $pdo->fetch(PDO::FETCH_ASSOC);
        if (!$product) {
            return null;
        }
        $sql = "SELECT suppliers.id, suppliers.name FROM suppliers INNER JOIN supplier_product ON suppliers.id = supplier_product.id_supplier WHERE supplier_product.id_product = :id;";
        $pdo = Config::cnx()->prepare($sql);
        $pdo->bindParam(":id", $dataID, PDO::PARAM_INT);
        $pdo->execute();
        $suppliers = $pdo->fetchAll(PDO::FETCH_ASSOC);
        $answer = array("product" => $product, "suppliers" => $suppliers);
        return $answer;
        $pdo->close();
    }

    public static function showQuantityM($dbTable){
        $sql = "SELECT products.id, products.name, quantity, desired_quantity FROM $dbTable";
        $pdo = Config::cnx()->prepare($sql);
        $pdo->execute();
        return $pdo->fetchAll(PDO::FETCH_ASSOC);
        $pdo->close();
        
    }

    public static function showProductSuppliersM($dbTable, $dataID){
        $sql = "SELECT suppliers.* FROM suppliers INNER JOIN supplier_product ON suppliers.id = supplier_product.id_supplier WHERE supplier_product.id_product = :id;";
        $pdo = Config::cnx()->prepare($sql);
        $pdo->bindParam(":id", $dataID, PDO::PARAM_INT);
        $pdo->execute();
        $suppliers = $pdo->fetchAll(PDO::FETCH_ASSOC);
        return $suppliers;
        $pdo->close();
    }

    public static function addProductM($dbTable, $regData, $suppliers){
        try {

            $pdo = Config::cnx();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            // Insertar producto
            $stmt = $pdo->prepare("INSERT INTO $dbTable (name, id_subcategory, cost, price, quantity, desired_quantity) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$regData["name"], $regData["subcategory_id"], $regData["cost"], $regData["price"], $regData["quantity"], $regData["d_quantity"]]);
            //Consigo el id del producto insertado
            $productId = $pdo->lastInsertId();
            // Insertar en la tabla supplier_product
            $query = "INSERT INTO supplier_product (id_supplier, id_product) VALUES ";
            //Recorro el array de proveedores y lo concateno a la query
            foreach($suppliers as $key => $value){
                $query = $query."($value, $productId),";
            }
            //Elimino la última coma de la query
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

    public static function editProductM($dbTable, $regData, $dataID){
        try {
            $pdo = Config::cnx();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Actualizar producto
            $stmt = $pdo->prepare("UPDATE $dbTable SET name = ?, id_subcategory = ?, cost = ?, price = ?, quantity = ?, desired_quantity = ? WHERE id = ?");
            $stmt->execute([$regData["name"], $regData["subcategory_id"], $regData["cost"], $regData["price"], $regData["quantity"], $regData["d_quantity"], $dataID]);
            // Eliminar proveedores existentes
            $stmt = $pdo->prepare("DELETE FROM supplier_product WHERE id_product = ?");
            $stmt->execute([$dataID]);
            // Insertar nuevos proveedores
            if(empty($_POST['suppliers'])){
                return 1;
            }
            $query = "INSERT INTO supplier_product (id_supplier, id_product) VALUES ";
            //Recorro el array de proveedores y lo concateno a la query
            foreach($_POST['suppliers'] as $key => $value){
                $query = $query."($value, $dataID),";
            }
            //Elimino la última coma de la query
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
            echo "Error al editar producto: " . $e->getMessage();
        }
    }

    public static function deleteProductM($dbTable, $dataID){
        try {
            $pdo = Config::cnx();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Eliminar proveedores asociados
            $stmt = $pdo->prepare("DELETE FROM supplier_product WHERE id_product = ?");
            $stmt->execute([$dataID]);
            
            // Eliminar producto
            $stmt = $pdo->prepare("DELETE FROM $dbTable WHERE id = ?");
            $stmt->execute([$dataID]);
            
            
            
            return 1;
            $pdo->close();
        } catch (PDOException $e) {
            echo "Error al eliminar producto: " . $e->getMessage();
        }
    }

    public static function updateQuantityM($dbTable, $regData){
        try {
            $pdo = Config::cnx();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            // Actualizar cantidad
            $stmt = $pdo->prepare("UPDATE $dbTable SET quantity = ? WHERE id = ?");
            $stmt->execute([$regData["quantity"], $regData["id"]]);
    
            return 1;
        } catch (PDOException $e) {
            echo "Error al actualizar cantidad: " . $e->getMessage();
        }
    }


}

?>
