<div class = "row">
    <h1 class="col-2">Productos</h1>
</div>
<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
        $controller = new StockController();
        $controller->updateQuantityC();
    }

?>

<form action="" id="controlForm" method="POST" class="col-md-6">
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



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Modal de confirmación -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content bg-dark text-white">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmModalLabel">Confirmar actualización de stock</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <p>Se detectaron las siguientes diferencias:</p>
        <ul id="diffList" class="list-group list-group-flush text-white"></ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="confirmUpdate">Confirmar</button>
      </div>
    </div>
  </div>
</div>



<script>
document.getElementById("controlForm").addEventListener("submit", function(e) {
    e.preventDefault();

    const form = this;
    const quantities = document.querySelectorAll("input[name='quantity[]']");
    const lastQuantities = document.querySelectorAll("input[name='lastQuantity[]']");
    const productNames = document.querySelectorAll("table tbody tr td:first-child");

    const diffList = document.getElementById("diffList");
    diffList.innerHTML = "";

    let cambios = false;

    for (let i = 0; i < quantities.length; i++) {
        const actual = parseInt(lastQuantities[i].value) || 0;
        const nuevo = parseInt(quantities[i].value) || 0;
        const diferencia = nuevo - actual;

        if (diferencia !== 0) {
            cambios = true;
            const nombre = productNames[i].textContent;
            const item = document.createElement("li");
            item.className = "list-group-item bg-dark border-white text-white";
            item.style.textDecorationColor = "white";
            item.style.textDecorationStyle = "solid";
            item.innerText = `${nombre}: ${actual} → ${nuevo} (Δ ${diferencia})`;
            diffList.appendChild(item);
        }
    }

    if (!cambios) {
        alert("No se detectaron cambios.");
        return;
    }

    const modal = new bootstrap.Modal(document.getElementById("confirmModal"));
    modal.show();

    document.getElementById("confirmUpdate").onclick = function() {
        modal.hide();
        form.submit(); // Enviar el formulario tras confirmación
    };
});
</script>



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


