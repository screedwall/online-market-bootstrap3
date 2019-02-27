<?php
	require_once $_SERVER["DOCUMENT_ROOT"]."/constants.php";
	if(isset($_POST["pass"])){
		if($_POST["pass"]==md5($panel_pass)){
			$cat = R::dispense('categories');
			$cat->category=$_POST["category"];
			$cat->assoc=$_POST["assoc"];
			$cat->gen_cat=$_POST["gen_cat"];
			$id=R::store($cat);
			echo "$id";
		}
	}
?>