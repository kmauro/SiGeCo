<?php
    if(empty($_GET["id"])){
        echo "<h1>Agregar Proveedor</h1>";
    }else{
        echo '<div class = "row">
                <h1 class="col-3">Editar Proveedor</h1>
                <a class = "col-1" href="index.php?route=supplier"><button type="button" class="btn btn-danger">Borrar</button></a>
            </div>';
    }
?>
    

	<div class="row">
        <div class  = "col-1"></div>
        <div class="col-4">
            <form class="row g-3" method="POST" id="supplierForm">
                <div class="col-12">
                    <label for="name" class="form-label">Nombre Proveedor</label>
                    <input type="text" class="form-control" id="name" name="name" autocomplete=off placeholder="Nombre del Proveedor">
                </div>

                <div class="col-md-6">
                    <label for="cuit" class="form-label">CUIT</label>
                    <input type="number" class="form-control" id="cuit" name="cuit" autocomplete=off placeholder="99-99999999-9">
                </div>

                <div class="col-md-6">
                    <label for="phone" class="form-label">Telefono</label>
                    <input type="number" class="form-control" id="phone" name="phone" autocomplete=off placeholder="(011) 1234-5678">
                </div>

                <div class="col-12">
                    <label for="email" class="form-label">e-mail</label>
                    <input type="e-mail" class="form-control" id="email" name="email" placeholder="yourname@host.com">
                </div>

                <div class="col-12">
                    <label for="address" class="form-label">Direccion</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Calle Falsa 123">
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
    



        
    <?php
    
        $controller = new SupplierController();
        $controller->addSupplierC();
    
    ?>



<?php


?>