<?php
    // Chequeo si esta editanto o agregando un usuario
    $isEditing = !empty($_GET["id"]);
    $controller = new AdminController();

    // manejo de la peticion POST antes de cualquier salida
    // Si se recibe una peticion POST, se llama al controlador correspondiente
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($isEditing) {
            $controller->editUserC($_GET["id"]);
        } else {
            $controller->addUserC();
        }
        exit; 
    }

    //Si el usuario tiene permisos de admin, se carga el combo de niveles de acceso
    $accessCombo = $_SESSION["access_level"]==1 ? $controller->getAccessLevelC() : null;
    //Si estoy editando un usuario, se carga la info del mismo
    $userData = $isEditing ? $controller->showUserC($_GET["id"]) : null;

    //En caso de que no se encuentre el usuario, se muestra un mensaje de error
    if ($isEditing && !$userData) {
        echo '<h1>Error: Usuario no encontrado.</h1>';
        exit;
    }
    


    echo $isEditing ? '<div class = "row"><h1 class="col-3">Editar datos</h1><a class = "col-1" href="index.php?route=deleteUser&id='.$_GET["id"].'"><button type="button" class="btn btn-danger">Borrar</button></a> </div>' : '<h1>Agregar Usuario</h1>';
?>
    

	<div class="row">
        <div class  = "col-1"></div>
        <div class="col-4">
            <form class="row g-3" method="POST" id="userForm">
                <div class="col-md-6">
                    <label for="user" class="form-label">Usuario</label>
                    <input type="text" <?= $isEditing ? "disabled" : "" ?> class="form-control" id="user" name="user" autocomplete=off placeholder="Usuario" value="<?= $isEditing ? htmlspecialchars($userData["user"]) : '' ?>">
                </div>
                
                <?php 
                //Para agregar un usuario, o editar usuario con permisos de admin, se muestra el combo de niveles de acceso
                    if(!$isEditing || $_SESSION["access_level"] == 1){
                        echo '<div class="col-md-6">
                                <label for="accessLevel" class="form-label">Nivel de acceso</label>
                                <select id="accessLevel" name="accessLevel" class="form-select">';
                        foreach($accessCombo as $value){
                            echo '<option value="'.$value["id"].'">'.$value["access_level"].'</option>';
                        }        
                        echo '</select> </div>';
                        
                    }
                    //En caso de que no este editando, se muestra el campo de contraseña
                    //En caso de que este editando, se muestra un link para cambiar la contraseña
                    if(!$isEditing){
                        echo '<div class="col-12">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" autocomplete=off placeholder="Contraseña">
                            </div>';
                    }else{
                        echo '<a href="index.php?route=changePassword&id='.$_GET["id"].'">Cambiar contraseña</a>';
                    }
                ?>
                <div class="col-md-6">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nombre y Apellido" value="<?= $isEditing ? htmlspecialchars($userData['name']) : '' ?>">
                </div>
                <div class="col-md-6">
                    <label for="phone" class="form-label">Telefono</label>
                    <input type="number" class="form-control" id="phone" name="phone" autocomplete=off placeholder="(011) 1234-5678" value="<?= $isEditing ? htmlspecialchars($userData['phone_number']) : '' ?>">
                </div>
                <div class="col-12">
                    <label for="email" class="form-label">e-mail</label>
                    <input type="e-mail" class="form-control" id="email" name="email" placeholder="yourname@host.com" value="<?= $isEditing ? htmlspecialchars($userData['email']) : '' ?>">
                </div>


                <div class="col-12">
                    <button type="submit" class="btn btn-primary"><?= $isEditing ? 'Editar' : 'Agregar' ?></button>
                </div>
            </form>
        </div>
    </div>

