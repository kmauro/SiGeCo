
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
                
                if(selectId === "suppliers"){
                    data.forEach(item => {
                        const div = document.createElement("div");
                        div.classList.add("form-check");
                        div.innerHTML = `
                            <input class="form-check-input" type="checkbox" id="${item.name}" name="suppliers[]" value="${item.id}">
                            <label class="form-check-label" for="${item.name}">${item.name}</label>
                        `;

                        select.appendChild(div);
                    });
                }else{
                    select.innerHTML = '<option value="">Seleccione una opción</option>'
                    data.forEach(item => {
                        select.innerHTML += `<option value="${item.id}">${item.name}</option>`;
                    });
                }
                
            })
            .catch(error => console.error('Error cargando datos:', error));
    }
});
