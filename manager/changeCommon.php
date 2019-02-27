<?php
	require_once $_SERVER["DOCUMENT_ROOT"]."/constants.php";
	if(isset($_POST["pass"])){
		if($_POST["pass"]==md5($panel_pass)){
			$common = R::findAll('common');
			$common[1]->email=$_POST["email"];
			$common[1]->phone=strval($_POST["phone"]);
			$id = R::store($common[1]);
			echo "$id";
		}
	}
?>