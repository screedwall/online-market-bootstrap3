<?php
	session_start();
	require_once $_SERVER["DOCUMENT_ROOT"]."/constants.php";
	
	$response[]=[];
	$k=0;
	if(isset($_SESSION["cart"])){
		foreach ($_SESSION["cart"] as $key => $value) {
			if($key!=0){
			$item  = R::findOne( 'items', "id = $key");
			$response[$k]["id"]=$key;
	    	$response[$k]["name"]=$item->name;
	    	$response[$k]["price"]=$item->price;
	    	$response[$k]["value"]=$value;
	    	$response[$k]["count"]=$item->count;
	    	$response[$k]["items_left"]=$item->items_left;
	    	$response[$k]["img"]=$item->img;
	    	}else{
	    		$response[$k]["current"]=$value;
	    	}
	    	$k++;
	    }
    	echo json_encode($response);
    }else{
    	$response[0]["current"]=0;
    	echo json_encode($response);
    }
?>