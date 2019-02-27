<?php
	require_once $_SERVER["DOCUMENT_ROOT"]."/constants.php";
	
	$item  = R::findAll( 'categories');
	echo json_encode($item);
?>