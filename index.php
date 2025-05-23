<?php

require_once "Controllers/routeC.php";
require_once "Controllers/StockC.php";
require_once "Controllers/SupplierC.php";
require_once "Controllers/AdminC.php";

require_once "Models/routeM.php";
require_once "Models/StockM.php";
require_once "Models/SupplierM.php";
require_once "Models/AdminM.php";


$route = new RouteController();

session_start();

if(empty($_SESSION["logged"])){
	$route->login();
}else{
    $route->template();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGC</title>
</head>
<body style="background-color:#343a40;">
    
</body>
</html>


