<?php
	require_once $_SERVER["DOCUMENT_ROOT"]."/constants.php";
	if(isset($_POST["pass"])){
		if($_POST["pass"]==md5($panel_pass)){
			$items = R::findAll('items');
			echo json_encode($items);
		}
	}
?>