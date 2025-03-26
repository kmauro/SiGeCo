<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
 
 
 <div class="contenedor">
        <form class=" formulario align-items-center" method="post" action="">
            <div class="mb-3">
                <label for="userI" class="form-label">Usuario</label>
                <input type="text" class="form-control" name="userI" id="userI" required>
            </div>
            <div class="mb-3">
                <label for="passI" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="passI" name="passI" required>
            </div>
            <button type="submit" class="btn btn-primary ">Submit</button>
            <!-- <a href="signup" class="signup position-relative top-0 start-45"> Registrarse </a> -->

        </form>

    </div>

    <?php 

        $ingreso = new AdminController();
        $ingreso -> logInC();

    ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<style>
        .contenedor {
        max-width: fit-content;
        padding-top: 100px;
        margin-left: auto;
        margin-right: auto;
    }

    .formulario {
        color: black;
        font-family: Arial;
        background-color: white;
        padding: 15px;
        border-radius: 10px;
        border: black solid 2px;
    }

    .submit{
        font-family: "Arial Black";
        color: black;
        background-color: white;
        border-radius: 10px;
        border: black solid 2px;
        padding: 5px;
        padding-left: 10px;
        padding-right: 10px;
        transition: all 0.2s ease-in;
    }

    .submit:hover{
        color:white;
        background-color: black;
        border-color: white;
    }

    .signup{
        font-family: "Arial Black";
        color: black;
        background-color: white;
        border-radius: 10px;
        border: black solid 2px;
        padding: 5px;
        padding-left: 10px;
        padding-right: 10px;
        transition: all 0.2s ease-in;
    }

    .signup:hover{
        color:white;
        background-color: black;
        border-color: white;
    }
</style>
    