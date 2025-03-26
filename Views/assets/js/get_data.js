
document.addEventListener("DOMContentLoaded", function() {
    cargarOpciones("category", "categories");
    cargarOpciones("suppliers", "suppliers");

    document.getElementById("category").addEventListener("change", function() {
        let categoryId = this.value;
        cargarOpciones("subcategory", "subcategories", categoryId);
    });

    function cargarOpciones(selectId, type, categoryId = null) {
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
                    select.innerHTML += `<option value="${item.id}">${item.name}</option>`;
                });
            })
            .catch(error => console.error('Error cargando datos:', error));
    }
});
