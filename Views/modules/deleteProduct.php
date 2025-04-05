<?php 

$controller = new StockController();
$productID = $_GET["id"] ?? null;
$controller->deleteProductC($productID);

?>