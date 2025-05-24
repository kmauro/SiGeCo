<?php
    $isEditing = !empty($_GET["id"]);
    $controller = new AdminController();

    // Handle form submission BEFORE any output
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($isEditing) {
            $controller->editUserC($_GET["id"]);
        } else {
            $controller->addUserC();
        }
        exit; // Stop further output after redirect
    }

    $accessCombo = $_SESSION["access_level"]==1 ? $controller->getAccessLevelC() : null;
    $userData = $isEditing ? $controller->showUserC($_GET["id"]) : null;
    


    echo $isEditing ? '<div class = "row"><h1 class="col-3">Editar datos</h1><a class = "col-1" href="index.php?route=deleteUser&id='.$_GET["id"].'"><button type="button" class="btn btn-danger">Borrar</button></a> </div>' : '<h1>Agregar Usuario</h1>';
?>
    

	<div class="row">
        <div class  = "col-1"></div>
        <div class="col-4">
            <form class="row g-3" method="POST" id="userForm">
                <div class="col-md-6">
                    <label for="user" class="form-label">Usuario</label>
                    <input type="text" <?php if($isEditing){echo "disabled";}?> class="form-control" id="user" name="user" autocomplete=off placeholder="Usuario" value="<?= $isEditing ? htmlspecialchars($userData["user"]) : '' ?>">
                </div>
                
                <?php 
                    if(!$isEditing || $_SESSION["access_level"] == 1){
                        echo '<div class="col-md-6">
                                <label for="accessLevel" class="form-label">Nivel de acceso</label>
                                <select id="accessLevel" name="accessLevel" class="form-select">';
                        foreach($accessCombo as $value){
                            echo '<option value="'.$value["id"].'">'.$value["access_level"].'</option>';
                        }        
                        echo '</select> </div>';
                        
                    }else{
                        echo '<a href="index.php?route=changePassword&id='.$_GET["id"].'">Cambiar contraseña</a>';
                    }
                    if(!$isEditing){
                        echo '<div class="col-12">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" autocomplete=off placeholder="Contraseña">
                            </div>';
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

