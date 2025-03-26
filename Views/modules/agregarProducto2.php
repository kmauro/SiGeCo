<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Proveedores</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .product-list {
            max-height: 200px; /* Hace la lista scrolleable */
            overflow-y: auto;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body class="container mt-4">

    <h2>Agregar Proveedor</h2>

    <form id="proveedorForm">
        <!-- Selección de categoría -->
        <div class="mb-3">
            <label for="categoria" class="form-label">Selecciona una categoría:</label>
            <select id="categoria" class="form-select">
                <option value="">-- Selecciona una categoría --</option>
                <option value="electronica">Electrónica</option>
                <option value="ropa">Ropa</option>
                <option value="alimentos">Alimentos</option>
            </select>
        </div>

        <!-- Lista de productos con checkboxes -->
        <div class="mb-3">
            <label class="form-label">Selecciona los productos vendidos:</label>
            <div id="productosLista" class="product-list">
                <!-- Aquí se cargarán los productos dinámicamente -->
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Proveedor</button>
    </form>

    <script>
        // Lista de productos simulada (esto puede venir de una base de datos)
        const productos = {
            electronica: ["Televisor", "Celular", "Laptop", "Auriculares"],
            ropa: ["Camiseta", "Pantalón", "Chaqueta", "Zapatos"],
            alimentos: ["Pan", "Leche", "Frutas", "Verduras"]
        };

        document.getElementById("categoria").addEventListener("change", function() {
            const categoriaSeleccionada = this.value;
            const productosLista = document.getElementById("productosLista");

            // Limpiar la lista antes de mostrar nuevos productos
            productosLista.innerHTML = "";

            if (categoriaSeleccionada && productos[categoriaSeleccionada]) {
                productos[categoriaSeleccionada].forEach(producto => {
                    const div = document.createElement("div");
                    div.classList.add("form-check");

                    div.innerHTML = `
                        <input class="form-check-input" type="checkbox" id="${producto}" name="productos[]" value="${producto}">
                        <label class="form-check-label" for="${producto}">${producto}</label>
                    `;

                    productosLista.appendChild(div);
                });
            }
        });

        // Manejo del envío del formulario
        document.getElementById("proveedorForm").addEventListener("submit", function(event) {
            event.preventDefault();
            const seleccionados = Array.from(document.querySelectorAll("#productosLista input:checked"))
                                      .map(input => input.value);
            alert("Productos seleccionados: " + seleccionados.join(", "));
        });
    </script>

</body>
</html>
