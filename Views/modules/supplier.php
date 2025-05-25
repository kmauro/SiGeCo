<?php
    // Chequeo si esta editanto o agregando un proveedor
    $isEditing = !empty($_GET["id"]);
    $controller = new SupplierController();

    // manejo de la peticion POST antes de cualquier salida
    // Si se recibe una peticion POST, se llama al controlador correspondiente
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($isEditing) {
            $controller->editSupplierC($_GET["id"]);
        } else {
            $controller->addSupplierC();
        }
        exit; 
    }
    // Si no se recibe una peticion POST, se carga el formulario
    // Se obtiene la info de proveedores si se esta editando
    $supplierData = $isEditing ? $controller->showSupplierC($_GET["id"]) : null;
    
    //En caso de que no se encuentre el proveedor, se muestra un mensaje de error
    if ($isEditing && !$supplierData) {
        echo '<h1>Error: Proveedor no encontrado.</h1>';
        exit;
    }

    echo $isEditing ? '<div class = "row"><h1 class="col-3">Editar Proveedor</h1><a class = "col-1" href="index.php?route=deleteSupplier&id='.$_GET["id"].'"><button type="button" class="btn btn-danger">Borrar</button></a> </div>' : '<h1>Agregar Proveedor</h1>';
?>
    
<!-- Formulario de proveedor -->
	<div class="row">
        <div class  = "col-1"></div>
        <div class="col-4">
            <form class="row g-3" method="POST" id="supplierForm">
                <div class="col-12">
                    <label for="name" class="form-label">Nombre Proveedor</label>
                    <input type="text" class="form-control" id="name" name="name" autocomplete=off placeholder="Nombre del Proveedor" value="<?= $isEditing ? htmlspecialchars($supplierData["name"]) : '' ?>">
                </div>

                <div class="col-md-6">
                    <label for="cuit" class="form-label">CUIT</label>
                    <input type="number" class="form-control" id="cuit" name="cuit" autocomplete=off placeholder="99-99999999-9" value="<?= $isEditing ? htmlspecialchars($supplierData["cuit"]) : '' ?>">
                </div>

                <div class="col-md-6">
                    <label for="phone" class="form-label">Telefono</label>
                    <input type="number" class="form-control" id="phone" name="phone" autocomplete=off placeholder="(011) 1234-5678" value="<?= $isEditing ? htmlspecialchars($supplierData['phone_number']) : '' ?>">
                </div>

                <div class="col-12">
                    <label for="email" class="form-label">e-mail</label>
                    <input type="e-mail" class="form-control" id="email" name="email" placeholder="yourname@host.com" value="<?= $isEditing ? htmlspecialchars($supplierData['email']) : '' ?>">
                </div>

                <div class="col-12">
                    <label for="address" class="form-label">Direccion</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Calle Falsa 123" value="<?= $isEditing ? htmlspecialchars($supplierData['address']) : '' ?>">
                </div>


                <div class="col-12">
                    <button type="submit" class="btn btn-primary"><?= $isEditing ? 'Editar' : 'Agregar' ?></button>
                </div>
            </form>
        </div>
    </div>
