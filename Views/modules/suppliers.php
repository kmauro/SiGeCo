	<div class="row">
		<h1 class="col-2">Proveedores</h1>
		<?php
			if($_SESSION["access_level"] == 1 && empty($_GET["id"])){
				echo '<a class = "col-1" href="index.php?route=agregarProducto"><button type="button" class="btn btn-primary">Agregar</button></a>';
			}
		?>
	</div>

	<table class="table table-dark  table-bordered table-striped">
		
		<thead>
			
			<tr>
				
				<th>Nombre</th>
				<th>CUIT</th>
				<th>email</th>
				<th>telefono</th>
				<th>Direccion</th>
				<th></th>
				<th></th>

			</tr>

		</thead>

		<tbody>
			
			

			<?php
				$mostar = new SupplierController();
				$mostar->showSupplierC();

			?>
		</tbody>

	</table>


	<style>
		.row{
			padding-bottom: 20px;
		}

		.table {
			padding-top: 25px;
			border-radius: 8px;
			overflow: hidden; /* Evita que los bordes se corten */
			box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
		}
	</style>
