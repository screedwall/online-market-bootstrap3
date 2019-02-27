<?php
	require_once $_SERVER["DOCUMENT_ROOT"]."/constants.php";
	if(isset($_POST["pass"])){
		if($_POST["pass"]==md5($panel_pass)){
			$img=$_POST["img"];
			$item = R::dispense('items');
			$item->name=$_POST["item-name"];
			$item->count=$_POST["item-count"];
			$item->price=$_POST["item-price"];
			$item->items_left=$_POST["items_left"];
			$item->category=$_POST["item-category"];
			$item->img=$img;
			$key=R::store($item);
			echo "$key";
		}
	}
?>