document.addEventListener("DOMContentLoaded", function() {
    
    const isEditing = document.getElementById("flag").classList.contains("isEditing");

    const categorySelect = document.getElementById("category");
    const subcategorySelect = document.getElementById("subcategory");

    if (!isEditing) {
        
        // Carga categorías y subcategorías normalmente en modo "Agregar"
        cargarOpciones("category", "categories");

        categorySelect.addEventListener("change", function () {
            let categoryId = this.value;
            cargarOpciones("subcategory", "subcategories", categoryId);
        });
    } else {
        
        // En modo edición, solo actualizar subcategorías al cambiar categoría
        categorySelect.addEventListener("change", function () {
            let categoryId = this.value;
            cargarOpciones("subcategory", "subcategories", categoryId);
        });

        // Precarga subcategoría actual si existe
        const categoriaSeleccionada = categorySelect.value;
        const subcategoriaSeleccionada = document.getElementById("subcategoryActual")?.value;

        if (categoriaSeleccionada && subcategoriaSeleccionada) {
            cargarOpciones("subcategory", "subcategories", categoriaSeleccionada, subcategoriaSeleccionada);
        }
    }

    function cargarOpciones(selectId, type, categoryId = null, valorSeleccionado = null) {
        let url = `Controllers/get_data.php?type=${type}`;
        if (categoryId) {
            url += `&id_category=${categoryId}`;
        }

        fetch(url)
            .then(response => response.json())
            .then(data => {
                let select = document.getElementById(selectId);
                select.innerHTML = '<option value="">Seleccione una opción</option>';
                data.forEach(item => {
                    const selected = (valorSeleccionado && item.id == valorSeleccionado) ? 'selected' : '';
                    select.innerHTML += `<option value="${item.id}" ${selected}>${item.name}</option>`;
                });
            })
            .catch(error => console.error('Error cargando datos:', error));
    }
});

