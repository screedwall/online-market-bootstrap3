<?php
	require_once $_SERVER["DOCUMENT_ROOT"]."/constants.php";
	if(isset($_POST["pass"])){
		if($_POST["pass"]==md5($panel_pass)){
			$cats = R::findAll('categories');
			echo json_encode($cats);
		}
	}
?>