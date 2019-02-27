<?php
	require_once $_SERVER["DOCUMENT_ROOT"]."/constants.php";
	if(isset($_POST["pass"])){
		if($_POST["pass"]==md5($panel_pass)){
			$id=$_POST["id"];
			$order = R::findOne('orders', 'id = ?',["$id"]);
			$record=json_decode($order["items_array"], true);

			for ($i=1; $i <= $record[0]["current"]; $i++) { 
				$id=$record[$i]["id"];
				$item = R::findOne('items', 'id = ?',["$id"]);
				$item->items_left=($item->items_left)-($record[$i]["value"]);
				$id = R::store($item);
				echo " Заказано: ".$record[$i]["value"]." Осталось: ".$item->items_left." ID: ".$item->id;
			}
			$order->status="Утвержден";
			$id = R::store($order);
		}
	}
?>