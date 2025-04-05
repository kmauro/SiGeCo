<?php
    $isEditing = !empty($_GET["id"]);
    $controller = new StockController();
    $productData = $isEditing ? $controller->showProductC($_GET["id"]) : null;
    $product = $productData["product"] ?? null;
    $suppliers = $productData["suppliers"] ?? null;

    if ($isEditing && !$productData) {
        echo '<h1>Error: Producto no encontrado.</h1>';
        exit;
    }

    echo $isEditing ? '<div class = "row"><h1 class="col-3">Editar Producto</h1><a class = "col-1" href="index.php?route=deleteProduct&id='.$_GET["id"].'"><button type="button" class="btn btn-danger">Borrar</button></a> </div>' : '<h1>Agregar Producto</h1>';
?>

<div class="row">
    <div class="col-1"></div>
    <div class="col-4">
        <form class="row g-3" method="POST" id="productoForm">
            <div class="col-12">
                <label for="name" class="form-label">Nombre Producto</label>
                <input type="text" class="form-control" id="name" name="name" autocomplete="off" placeholder="Nombre del producto" value="<?= $isEditing ? htmlspecialchars($product['name']) : '' ?>">
            </div>

            <div class="col-md-6">
                <label for="category" class="form-label">Categoría</label>
                <select id="category" name="category" class="form-select">
                    <?php if ($isEditing): ?>
                        <option value="<?= htmlspecialchars($product['categoryID']) ?>"><?= htmlspecialchars($product['category']) ?></option>
                    <?php endif; ?>
                </select>
            </div>

            <div class="col-md-6">
                <label for="subcategory" class="form-label">Subcategoría</label>
                <select id="subcategory" name="subcategory" class="form-select">
                    <?php if ($isEditing): ?>
                        <option value="<?= htmlspecialchars($product['subcategoryID']) ?>"><?= htmlspecialchars($product['subcategory']) ?></option>
                    <?php endif; ?>
                </select>
            </div>

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
                    <div class="row">
                        <?php
                        if ($isEditing) {
                            foreach ($suppliers as $supplier) {
                                echo '<div class="col-4"><input type="checkbox" name="suppliers[]" value="' . htmlspecialchars($supplier["id"]) . '" checked>' . htmlspecialchars($supplier["name"]) . '</div>';
                            }
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
<?php echo !$isEditing ? '<script src="Views/assets/js/get_data.js"> </script>' : null; ?>
<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$isEditing) {
        $controller->addProductC();
    }else{
        if ($isEditing) {
            $controller->editProductC($_GET["id"]);
        }
    }
?>