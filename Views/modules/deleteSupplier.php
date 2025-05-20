<?php 

$controller = new SupplierController();
$supplierID = $_GET["id"] ?? null;
$controller->deleteSupplierC($supplierID);

?>