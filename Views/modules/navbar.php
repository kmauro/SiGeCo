<!-- Sidebar -->
<div class="sidebar d-flex flex-column flex-shrink-0  " id="sidebar">
        
        <a href="#" class="menu-item" id="toggleBtn"><i class="fa-solid fa-bars"></i> <h1 class="menu-text">SGC</h1> </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">	
                <a href="index.php?route=dashboard" class="menu-item"><i class="fas fa-home"></i> <span class="menu-text">Inicio</span></a>
            </li>
            <li class="nav-item">
                <a href="index.php?route=stock" class="menu-item"><i class="bi bi-box-seam-fill"></i> <span class="menu-text">Stock</span></a>
            </li>
            <li class="nav-item">
                <a href="index.php?route=suppliers" class="menu-item"><i class="bi bi-person-lines-fill"></i> <span class="menu-text">Proveedores</span></a>
            </li>
            <li class="nav-item">
                <a href="index.php?route=register" class="menu-item"><i class="bi bi-person-plus"></i> <span class="menu-text">Registro</span></a>
            </li>
            <li class="nav-item">
                <a href="" class="menu-item"><i class=""></i> <span class="menu-text"></span></a>
            </li>
        </ul>
        <hr>
        <div class="dropdown" > 
            <a href="#" class="d-flex align-items-center menu-item link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                 <i class="bi bi-person-lines-fill" style="color:white;"></i> <span class="menu-text" style="color:white;"><?php echo $_SESSION["user"]; ?></span> 
            </a> 
            <ul class="dropdown-menu text-small shadow"> 
                <li><a class="dropdown-item" href="#">New project...</a></li> 
                <li><a class="dropdown-item" href="#">Settings</a></li> 
                <li><a class="dropdown-item" href="#">Profile</a></li> 
                <li><hr class="dropdown-divider"></li> 
                <li><a class="dropdown-item" href="index.php?route=exit">Sign out</a></li> 
            </ul> 
        </div>
    </div>

    