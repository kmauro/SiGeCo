<?php /*
//require_once '../config.php'; // Conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);
    $subcategory = $_POST['subcategory'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $d_quantity = $_POST['d_quantity'];
    $supplier = $_POST['supplier'];

    if (empty($nombre) || empty($subcategory) || empty($price) || empty($quantity) || empty($d_quantity) || empty($supplier)) {
        die("Todos los campos son obligatorios");
    }

    try {


        $pdo = new PDO("mysql:host=localhost;dbname=sisges", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insertar producto
        $stmt = $pdo->prepare("INSERT INTO productos (nombre, subcategory_id, price, quantity, quantity_deseada) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nombre, $subcategory, $price, $quantity, $d_quantity]);

        $productoID = $pdo->lastInsertId();

        $stmt = $pdo->prepare("INSERT INTO productos_supplieres (supplier_id, producto_id) VALUES (?, ?)");
        $stmt->execute([$supplier, $productoID]);
        if($stmt->execute([$supplier, $productoID])){
            return 1;
        }else{
            return 0;
        }
        header("location:index.php?route=stock");
        //$stmt->close();
    } catch (PDOException $e) {
        echo "Error al agregar producto: " . $e->getMessage();
    }


    
} */
?>



<?php
require_once '../config.php'; // Conexión a la base de datos
//esto por que esta repetido aca? esta en guardar_producto y en StockM
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['nombre']);
    $category = $_POST['category'];
    $subcategory = $_POST['subcategory'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $d_quantity = $_POST['d_quantity'];
    $supplier = $_POST['supplier'];

    if (empty($name) || empty($category) || empty($subcategory) || empty($price) || empty($quantity) || empty($supplier)) {
        die("Todos los campos son obligatorios");
    }

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=sigeco", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("INSERT INTO products (name, id_subcategory, price, quantity, desired_quantity) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $subcategory, $price, $quantity, $d_quantity]);

        $productID = $pdo->lastInsertId();

        $stmt = $pdo->prepare("INSERT INTO supplier_product (id_supplier, id_product) VALUES (?, ?)");
        if($stmt->execute([$supplier, $productID])){
            header("location:index.php?route=stock");
        }

        
    } catch (PDOException $e) {
        echo "Error al agregar producto: " . $e->getMessage();
    }
}
?>

