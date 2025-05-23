<div class = "row">
    <h1 class="col-2">Productos</h1>
</div>


<form action="POST" id="controlForm" method="POST">
    <table class="table table-dark  table-bordered table-striped">
        <thead>
            <tr>
            <th scope="col">Producto</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Cantidad Actual</th>
            <th scope="col">Cantidad Deseada</th>
            </tr>
        </thead>
        <tbody>
                <?php

                    $mostrar = new StockController();
                    $mostrar->showQuantityC();

                ?>
        </tbody>
    </table>
        <div class="row">
            <div class="col-2">
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </div>
</form>


<?php
    $controller = new StockController();
    $controller->updateQuantityC();

?>


<style>
  .row{
    padding-bottom: 20px;
  }

  .table {
    padding-top: 25px;
    border-radius: 8px;
    overflow: hidden; /* Evita que los bordes se corten */
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
}
</style>

