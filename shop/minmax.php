<?php
	require_once $_SERVER["DOCUMENT_ROOT"]."/constants.php";
	if(isset($_POST["category"])){
	
	$category=$_POST["category"];
	$item  = R::find( 'items', "price != 0 AND category LIKE ?", ["$category"]);
	$item=array_values($item);
	if($_POST["category"]!="shop"){
	$min=$item[0]->price;
}else{$min=0;}
	$max=$item[0]->price;
	for($i=1;$i<count($item);$i++){
		if($item[$i]->price>$max){
			$max=$item[$i]->price;
		}
		if($item[$i]->price<$min){
			$min=$item[$i]->price;
		}
	}
	$response["min"]=$min;
	$response["max"]=$max+1;
	echo json_encode($response);
	}
?>