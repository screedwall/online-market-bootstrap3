<?php
	require_once $_SERVER["DOCUMENT_ROOT"]."/constants.php";
	
	if(isset($_POST["cart"])){
		if($_POST["name"]!=""&&$_POST["phone"]!=""&&$_POST["email"]!=""){
			$order = R::dispense( 'orders' );
			$order->items_array = $_POST["cart"];
			$order->name=$_POST["name"];
			$order->phone=$_POST["phone"];
			$order->email=$_POST["email"];
			$order->sum=$_POST["sum"];
			$id = R::store( $order );

			$item=R::findOne( 'orders', "id = $id");

			$subject = 'Заказ номер '.$item->id.' с сайта '.$sname;
			$message = 'Покупатель ожидает подтверждения заказа номер '.$item->id.'. Дата заказа '.$item->timestamp;

			//mail($email, $subject, $message);
			echo "Заказ успешно оформлен. С вами свяжутся в ближайшее время. Ваш номер заказа - ".$item->id;
		}else{
			die("Нельзя оставлять поля пустыми");
		}
	}
?>