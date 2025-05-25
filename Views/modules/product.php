<?php
    //Chequeo si esta editanto o agregando un producto
    $isEditing = !empty($_GET["id"]);
    $controller = new StockController();

    // manejo de la peticion POST antes de cualquier salida
    // Si se recibe una peticion POST, se llama al controlador correspondiente
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($isEditing) {
            $controller->editProductC($_GET["id"]);
        } else {
            $controller->addProductC();
        }
        exit; 
    }

    // Si estoy editando un producto, se carga la info del mismo
    // Y se obtiene la info de proveedores del producto
    $productData = $isEditing ? $controller->showProductC($_GET["id"]) : null;
    $product = $productData["product"] ?? null;
    $suppliersChecked = $productData["suppliers"] ?? null;
    //Consigo el resto de proveedores que no son del producto
    $sController = new SupplierController();
    $suppliersList = $sController->showSupplierC();
    //Consigo las categorias y subcategorias
    $categories = $controller->showCategoriesC();
    $subcategories = $controller->showSubcategoriesC($product['categoryID'] ?? null);


    //En caso de que no se encuentre el producto, se muestra un mensaje de error
    if ($isEditing && !$productData) {
        echo '<h1>Error: Producto no encontrado.</h1>';
        exit;
    }

    echo $isEditing ? '<div class = "row"><h1 class="col-3">Editar Producto</h1><a class = "col-1" href="index.php?route=deleteProduct&id='.$_GET["id"].'"><button type="button" class="btn btn-danger">Borrar</button></a> </div>' : '<h1>Agregar Producto</h1>';
?>

<div class="row">
    <div class="col-1 <?= $isEditing ? "isEditing" : "" ?>" id="flag"></div>
    <div class="col-4">
        <form class="row g-3" method="POST" id="productoForm">
            <div class="col-12">
                <label for="name" class="form-label">Nombre Producto</label>
                <input type="text" class="form-control" id="name" name="name" autocomplete="off" placeholder="Nombre del producto" value="<?= $isEditing ? htmlspecialchars($product['name']) : '' ?>">
            </div>
            <?php if ($isEditing): ?>
                <input type="hidden" id="categoryActual" value="<?= htmlspecialchars($product['categoryID']) ?>">
                <input type="hidden" id="subcategoryActual" value="<?= htmlspecialchars($product['subcategoryID']) ?>">
                
            <?php endif; ?>
            <?php 
             echo '<div class="col-md-6">
                <label for="category" class="form-label">Categoría</label>
                <select id="category" name="category" class="form-select">';
                            
                        foreach ($categories as $category) {
                            $selected = $isEditing && $product['categoryID'] == $category['id'] ? 'selected' : '';
                            echo '<option value="' . htmlspecialchars($category['id']) . '" ' . $selected . '>' . htmlspecialchars($category['category']) . '</option>';
                        }
                    
                echo '</select>
            </div>
            
            <div class="col-md-6">
                <label for="subcategory" class="form-label">Subcategoría</label>
                <select id="subcategory" name="subcategory" class="form-select">';
                    
                        foreach ($subcategories as $subcategory) {
                            $selected = $isEditing && $product['subcategoryID'] == $subcategory['id'] ? 'selected' : '';
                            echo '<option value="' . htmlspecialchars($subcategory['id']) . '" ' . $selected . '>' . htmlspecialchars($subcategory['subcategory']) . '</option>';
                        }
                    
                echo '</select>
            </div>';
            ?>
            <div class="col-md-6">
                <label for="cost" class="form-label">Costo</label>
                <input type="number" class="form-control" id="cost" name="cost" placeholder="99999" value="<?= $isEditing ? htmlspecialchars($product['cost']) : '' ?>">
            </div>

            <div class="col-md-6">
                <label for="price" class="form-label">Precio</label>
                <input type="number" class="form-control" id="price" name="price" placeholder="99999" value="<?= $isEditing ? htmlspecialchars($product['price']) : '' ?>">
            </div>

            <div class="col-md-6">
                <label for="quantity" class="form-label">Cantidad</label>
                <input type="number" class="form-control" id="quantity" name="quantity" placeholder="999" value="<?= $isEditing ? htmlspecialchars($product['quantity']) : '' ?>">
            </div>

            <div class="col-md-6">
                <label for="d_quantity" class="form-label">Cantidad Deseada</label>
                <input type="number" class="form-control" id="d_quantity" name="d_quantity" placeholder="999" value="<?= $isEditing ? htmlspecialchars($product['desired_quantity']) : '' ?>">
            </div>

            <div class="col-12">
                <label for="suppliers" class="form-label">Proveedores:</label>
                <div id="suppliers" name="suppliers" class="product-list">
                    <div class="form-check">
                        <?php
                        foreach($suppliersList as $supplier) {
                            $checked = '';
                            if ($isEditing) {
                                foreach ($suppliersChecked as $supplierChecked) {
                                    if ($supplier["id"] == $supplierChecked["id"]) {
                                        $checked = 'checked';
                                        break;
                                    }
                                }
                            }
                            echo '<input class="form-check-input" type="checkbox" id="'.htmlspecialchars($supplier["name"]).'" name="suppliers[]" '.$checked.' value="'.htmlspecialchars($supplier["id"]).'">';
                            echo '<label class="form-check-label" for="'.htmlspecialchars($supplier["name"]).'">'.htmlspecialchars($supplier["name"]).'</label> <br>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary"><?= $isEditing ? 'Editar' : 'Agregar' ?></button>
            </div>
        </form>
    </div>
</div>
<script src="Views/assets/js/get_data.js"> </script>