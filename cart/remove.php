<?php
	session_start();
	$id=$_POST["id"];
	unset($_SESSION["cart"][$id]);
	$_SESSION["cart"]["current"]--;
?>