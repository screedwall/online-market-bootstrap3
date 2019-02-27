<?php
	if(isset($_POST["id"])){
	require_once $_SERVER["DOCUMENT_ROOT"]."/constants.php";
	
	$id=$_POST["id"];
	$item  = R::find( 'items', "id = $id");

	echo $item[$id];
}else{
	die("Несанкционированная попытка получения доступа");
}
?>