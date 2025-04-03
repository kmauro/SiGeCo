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
    
    //MAYBE refactor this
    public function showProductC($dataID){
        $dbTable = "products";
        $answer = StockModel::showProductM($dbTable, $dataID);
            echo '  <div class="row">
                    <div class  = "col-1"></div>
                    <div class="col-4">
                        <form class="row g-3" method="POST" id="productoForm">
                            <div class="col-12">
                                <label for="name" class="form-label">Nombre Producto</label>
                                <input type="text" class="form-control" id="nameE" name="name" autocomplete=off placeholder="Nombre del producto" value="'.$answer["name"].'">
                            </div>

                            <div class="col-md-6">
                                <label for="category" class="form-label">Categoría</label>
                                <select id="categoryE" name="category" class="form-select">
                                    <option value='.$answer["categoryID"].'>'.$answer["category"].'</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="subcategory" class="form-label">Subcategoría</label>
                                <select id="subcategoryE" name="subcategory" class="form-select">
                                    <option value='.$answer["subcategoryID"].'>'.$answer["subcategory"].'</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="cost" class="form-label">Costo</label>
                                <input type="number" class="form-control" id="costE" name="cost" placeholder="99999" value="'.$answer["cost"].'">
                            </div>

                            <div class="col-md-6">
                                <label for="price" class="form-label">Precio</label>
                                <input type="number" class="form-control" id="priceE" name="price" placeholder="99999" value="'.$answer["price"].'">
                            </div>

                            <div class="col-md-6">
                                <label for="quantity" class="form-label">Cantidad</label>
                                <input type="number" class="form-control" id="quantityE" name="quantity" placeholder="999" value="'.$answer["quantity"].'">
                            </div>

                            <div class="col-md-6">
                                <label for="d_quantity" class="form-label">Cantidad Deseada</label>
                                <input type="number" class="form-control" id="d_quantityE" name="d_quantity" placeholder="999" value="'.$answer["desired_quantity"].'">
                            </div>

                            <div class="col-12">
                                <label for="suppliers" class="form-label">Proveedores:</label>
                                <div id="suppliersE" name="suppliers" class="product-list">
                                    <div class="row">';
                                        $suppliers = explode(",", $answer["suppliers"]);
                                        foreach($suppliers as $key => $value){
                                            echo '<div class="col-4"><input type="checkbox" name="suppliers[]" value="'.$value.'" checked>'.$value.'</div>';
                                        }
                                    echo '</div>
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">';
                                   
                                        if(empty($_GET["id"])){
                                            echo "Agregar";
                                        }else{
                                            echo "Editar";
                                        }
                                    
                                echo'</button>
                            </div>
                        </form>
                    </div>
                </div>';
        
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

    
}

?>