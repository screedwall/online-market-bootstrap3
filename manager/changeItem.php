<?php
	require_once $_SERVER["DOCUMENT_ROOT"]."/constants.php";
	if(isset($_POST["pass"])){
		if($_POST["pass"]==md5($panel_pass)){
			$id=$_POST["id"];
			$img=$_POST["img"];
			$item = R::findOne('items', 'id = ?', ["$id"]);
			$item->name=$_POST["item-name"];
			$item->count=$_POST["item-count"];
			$item->price=$_POST["item-price"];
			$item->items_left=$_POST["items_left"];
			$item->category=$_POST["item-category"];
			$item->img=$img;
			$id = R::store($item);
			echo $id;
		}
	}
?>