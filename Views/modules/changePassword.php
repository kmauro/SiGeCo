<div class="row">
    <h1>Cambiar contraseña</h1>
</div>

<div class="row">
    <div class="col-4">
        <form class="row g-3" method="POST" id="userForm">
            <div class="col-md-4">
                <label for="password" class="form-label">Contraseña Actual</label>
                <input type="password" class="form-control" id="password" name="password" autocomplete=off placeholder="Contraseña">
            </div>
            <div class="col-md-4">
                <label for="newPassword" class="form-label">Nueva contraseña</label>
                <input type="password" class="form-control" id="newPassword" name="newPassword" autocomplete=off placeholder="Contraseña">
            </div>
            <div class="col-md-4">
                <label for="confirmPassword" class="form-label">Confirmar contraseña</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" autocomplete=off placeholder="Confirmar contraseña">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Cambiar contraseña</button>
            </div>
            <div class="col-md-4" id="error">
                
            </div>
        </form>
    </div>

    <?php
        $controller = new AdminController();
        $controller->changePasswordC();


    ?>
    

    <script>
        const newPassword = document.getElementById("newPassword");
        const confirm = document.getElementById("confirmPassword");
        const error = document.getElementById("error");

        confirm.addEventListener("input", function() {
            if (newPassword.value !== confirm.value) {
                confirm.setCustomValidity("Las contraseñas no coinciden");
                error.innerHTML = "<a style='color:red'>Las contraseñas no coinciden</a>";
            } else {
                error.innerHTML = "<a></a>";
            }
        });
    </script>

