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

.table {
    border-radius: 8px;
    overflow: hidden; /* Evita que los bordes se corten */
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
}
	</style>
