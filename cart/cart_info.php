<?php
if(isset($_POST["id"])){
	session_start();
	$response=[];
	$id=$_POST["id"];
	foreach ($_SESSION["cart"] as $key => $value) {
    		if($id==$key){
    			$response["current"]=$_SESSION["cart"]["current"];
    			$response["value"]=$_SESSION["cart"][$id];
    		}
    	}

    echo json_encode($response);
}else{
	die("Несанкционированная попытка получения доступа");
}
?>