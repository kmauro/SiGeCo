<?php

class StockController{

    public function showStockC(){
        $dataID = null;
        $dbTable = "products";
        if(!empty($_GET["id"])){
            $dataID = $_GET["id"]; //Si se cumple es porque estoy filtrando por subcategory.
        }
        $answer = StockModel::showStockM($dbTable, $dataID);


        foreach($answer as $key => $value){
            echo '<tr>
                    
                    <td>'.$value["name"].'</td>
                    <td>'.$value["category"].'</td>
                    <td>'.$value["subcategory"].'</td>';
                    if($_SESSION["access_level"] == 1){
                        echo '<td>'.$value["cost"].'</td>';
                    }
                    echo '<td>'.$value["price"].'</td>
                    <td>'.$value["quantity"].'/'.$value["desired_quantity"].'</td>
                    <td><a href="index.php?route=suppliers&id='.$value["id"].'"<button>Ver</button></a></td>';
                    if($_SESSION["access_level"] == 1){
                        echo '<td><a href="index.php?route=product&id='.$value["id"].'"<button>Editar</button></a></td>';
                    }
                    
                echo '</tr>';
        }
    }
    
    public function showProductC($dataID) {
        $dbTable = "products";
        $answer = StockModel::showProductM($dbTable, $dataID);

        if (!$answer) {
            return null;
        }else{
            return $answer;
        }
    }

    public function showProductSuppliersC($dataID) {
        $dbTable = "products";
        $answer = StockModel::showProductSuppliersM($dbTable, $dataID);

        if (!$answer) {
            return null;
        }else{
            return $answer;
        }

    }

    public function showQuantityC(){
        $dataID = null;
        $dbTable = "products";
        $answer = StockModel::showQuantityM($dbTable, $dataID);
        foreach($answer as $key => $value){
            echo '<tr> <td>'.$value["name"].'</td>
                        <td>'.$value["quantity"].'</td>
                        <input type="hidden" name="id[]" value="'.$value["id"].'"> 
                        <input type="hidden" name="lastQuantity[]" value="'.$value["quantity"].'"> 
                        <td> <input type="text" name="quantity[]" class="form-control" autocomplete="off" placeholder="999"> </td>
                        <td>'.$value["desired_quantity"].'</td>
                    </tr>';

        }
    }

    public function showCategoriesC(){
        $dbTable = "categories";
        $answer = StockModel::showCategoriesM($dbTable);
        return $answer;
    }

    public function showSubcategoriesC($dataID){
        $dbTable = "subcategories";
        $answer = StockModel::showSubcategoriesM($dbTable, $dataID);
        return $answer;
    }

    public function addProductC(){
        $dbTable = "products";
        if (empty($_POST['suppliers']) || empty($_POST['name']) || empty($_POST['subcategory']) || empty($_POST['cost']) || empty($_POST['price']) || empty($_POST['quantity']) || empty($_POST['d_quantity']) || empty($_POST['suppliers'])) {
            die("Todos los campos son obligatorios");
        }else{
            $regData = array("name"=>$_POST['name'], "subcategory_id"=>$_POST['subcategory'], "cost"=>$_POST['cost'], "price"=>$_POST['price'], "quantity"=>$_POST['quantity'], "d_quantity"=>$_POST['d_quantity']);
            $suppliers = $_POST['suppliers'];
            $answer = StockModel::addProductM($dbTable, $regData, $suppliers);

            if($answer == 1){
                header("location:index.php?route=stock");
            }else{
                echo "error";
            }
        }
    }

    public function editProductC($dataID) {
        $dbTable = "products";
        if (empty($_POST['suppliers']) || empty($_POST['name']) || empty($_POST['subcategory']) || empty($_POST['cost']) || empty($_POST['price']) || empty($_POST['quantity']) || empty($_POST['d_quantity'])) {
            die("Todos los campos son obligatorios");
        } else {
            $regData = array(
                "name" => $_POST['name'],
                "subcategory_id" => $_POST['subcategory'],
                "cost" => $_POST['cost'],
                "price" => $_POST['price'],
                "quantity" => $_POST['quantity'],
                "d_quantity" => $_POST['d_quantity']
            );
            $answer = StockModel::editProductM($dbTable, $regData, $dataID);

            if ($answer == 1) {
                header("Location: index.php?route=stock");
                exit;
            } else {
                echo "error";
            }
        }
    }

    public function updateQuantityC(){
        $dbTable = "products";
        if(empty($_POST['quantity']) || empty($_POST['id']) || empty($_POST['lastQuantity'])){
            die("Todos los campos son obligatorios");
        }else{
            $ids = $_POST['id'];
            $lastQuantities = $_POST['lastQuantity'];
            $newQuantities = $_POST['quantity'];

            $regData = [];

            for ($i = 0; $i < count($ids); $i++) {
                $id = intval($ids[$i]);
                $last = intval($lastQuantities[$i]);
                $new = intval($newQuantities[$i]);
                if ($new !== $last) {
                    $regData[] = [
                        'id' => $id,
                        'quantity' => $new
                    ];
                }
            }
            if (!empty($regData)) {
                $answer = StockModel::updateQuantityM($dbTable, $regData);
                if ($answer == 1) {
                    header("location:index.php?route=stock");
                } else {
                    echo "error";
                }
            }
        }
    }

    public function deleteProductC($dataID){
        $dbTable = "products";
        $answer = StockModel::deleteProductM($dbTable, $dataID);

        if($answer == 1){
            header("location:index.php?route=stock");
        }else{
            echo "error";
        }
    }
        
}

?>