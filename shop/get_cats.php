<?php
	if(isset($_POST["category"])){
		require_once $_SERVER["DOCUMENT_ROOT"]."/constants.php";
		
		$category=$_POST["category"];
		$item  = R::findOne( 'categories', 'category = ?', ["$category"]);
		$response["assoc"]=$item->assoc;
		$response["gen_cat"]=$item->gen_cat;
		echo json_encode($response);
	}

?>