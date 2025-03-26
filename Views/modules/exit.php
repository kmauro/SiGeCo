<?php


if(!$_SESSION["logged"]){
	header("location:index.php?route=login");
	exit();
}else{
	session_destroy();
	header("location:index.php?route=login");
}
	
?>

