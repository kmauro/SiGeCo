<?php 

$controller = new AdminController();
$userID = $_GET["id"] ?? null;
$controller->deleteUserC($userID);

?>