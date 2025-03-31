<?php
    if(empty($_GET["id"])){
        echo "<h1>Agregar Producto</h1>";
    }else{
        echo '<div class = "row">
                <h1 class="col-3">Editar Producto</h1>
                <a class = "col-1" href="index.php?route=product"><button type="button" class="btn btn-danger">Borrar</button></a>
            </div>';
    }
?>
    

	<div class="row">
        <div class  = "col-1"></div>
        <div class="col-4">
            <form class="row g-3" method="POST" id="productoForm">
                <div class="col-12">
                    <label for="name" class="form-label">Nombre Producto</label>
                    <input type="text" class="form-control" id="name" name="name" autocomplete=off placeholder="Nombre del producto">
                </div>

                <div class="col-md-6">
                    <label for="category" class="form-label">Categoría</label>
                    <select id="category" name="category" class="form-select"></select>
                </div>

                <div class="col-md-6">
                    <label for="subcategory" class="form-label">Subcategoría</label>
                    <select id="subcategory" name="subcategory" class="form-select"></select>
                </div>

                <div class="col-md-6">
                    <label for="cost" class="form-label">Costo</label>
                    <input type="number" class="form-control" id="cost" name="cost" placeholder="99999">
                </div>

                <div class="col-md-6">
                    <label for="price" class="form-label">Precio</label>
                    <input type="number" class="form-control" id="price" name="price" placeholder="99999">
                </div>

                <div class="col-md-6">
                    <label for="quantity" class="form-label">Cantidad</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" placeholder="999">
                </div>

                <div class="col-md-6">
                    <label for="d_quantity" class="form-label">Cantidad Deseada</label>
                    <input type="number" class="form-control" id="d_quantity" name="d_quantity" placeholder="999">
                </div>

                <div class="col-12">
                    <label for="suppliers" class="form-label">Proveedores:</label>
                    <div id="suppliers" name="suppliers" class="product-list">
                    </div>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">
                        <?php 
                            if(empty($_GET["id"])){
                                echo "Agregar";
                            }else{
                                echo "Editar";
                            }
                        ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
    



    <script src="Views/assets/js/get_data.js"> </script>


        
    <?php
    
        $controller = new StockController();
        $controller->addProductC();
    
    ?>



<?php


?>