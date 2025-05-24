	<div class="row">
		<h1 class="col-2">Proveedores</h1>
		<?php
			if($_SESSION["access_level"] == 1 && empty($_GET["id"])){
				echo '<a class = "col-1" href="index.php?route=supplier"><button type="button" class="btn btn-primary">Agregar</button></a>';
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
				
				if(!empty($_GET["id"])){
					$controller = new StockController();	
					$answer = $controller->showProductSuppliersC($_GET["id"]);
				}else{
					$controller = new SupplierController();
					$answer = $controller->showSupplierC();
				}
				

				foreach($answer as $key => $value){
					echo '<tr>
							<td>'.$value["name"].'</td>
							<td>'.$value["cuit"].'</td>
							<td>'.$value["phone_number"].'</td>
							<td>'.$value["email"].'</td>
							<td>'.$value["address"].'</td>
							<td><a href="index.php?route=supplier&id='.$value["id"].'"<button>Editar</button></a></td>
							<td><a href="index.php?route=deleteSupplier&id='.$value["id"].'"<button>Borrar</button></a></td>
							
					</tr>';
				}

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
