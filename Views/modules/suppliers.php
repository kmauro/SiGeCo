	<h1>Proveedores</h1>

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

		
	</style>
