

<?php
    //editar los controladores para que se ejecuten en AdminC para 
    // desarrollar el editado y borrado de los usuarios.
    // tambien editar el array de los htmlspecialchars dentro de los inputs

    $isEditing = !empty($_GET["id"]);
    $controller = new AdminController();

    // Handle form submission BEFORE any output
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $isEditing) {
        $controller->editUserC($_GET["id"]);
        exit; // Stop further output after redirect
    }

    $userData = $isEditing ? $controller->showUserC($_GET["id"]) : null;
    


    echo $isEditing ? '<div class = "row"><h1 class="col-3">Editar datos</h1><a class = "col-1" href="index.php?route=deleteUser&id='.$_GET["id"].'"><button type="button" class="btn btn-danger">Borrar</button></a> </div>' : '<h1>Agregar Usuario</h1>';
?>
    

	<div class="row">
        <div class  = "col-1"></div>
        <div class="col-4">
            <form class="row g-3" method="POST" id="userForm">
                <div class="col-md-4">
                    <label for="user" class="form-label">Usuario</label>
                    <input type="text" <?php $isEditing ?  "disabled" : null; ?> class="form-control" id="user" name="user" autocomplete=off placeholder="Usuario" value="<?= $isEditing ? htmlspecialchars($userData["user"]) : '' ?>">
                </div>
                
                <?php 
                    if(!$isEditing){
                        echo '<div class="col-md-4">
                                <label for="accessLevel" class="form-label">Nivel de acceso</label>
                                <input type="number" class="form-control" id="accessLevel" name="accessLevel" autocomplete=off placeholder="999">
                                </div>';
                    }else{
                        echo '<a href="index.php?changePassword&id='.$_GET["id"].'">Cambiar contraseña TODO</a>';
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
    



        
    <?php
    
        $controller = new AdminController();
        $controller->addUserC();
    
    ?>

