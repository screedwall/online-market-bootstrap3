<?php
	require_once $_SERVER["DOCUMENT_ROOT"]."/constants.php";
	$item  = R::findAll( 'categories');
	$item=array_values($item);
	$limit=count($item);
	$count=0;
	$k=0;
	foreach ($item as $key => $value) {
		if($k==ceil($limit/6)*$count&&$k!=0){
			$count++;
			echo '</ul></div><div class="col-md-2"><ul><br>';
		}
		if ($k==ceil($limit/6)*$count) {
			$count++;
			echo '<div class="col-md-2"><ul><br>';
		}
		echo '<li><a class="footer-cats" href="/shop#'.$item[$key]->category.'"><span>'.$item[$key]->assoc.'</span></a></li>';
		$k++;
	}
	/*for ($i=0; $i < $limit; $i++){ 
		if($i==ceil($limit/6)*$count&&$i!=0){
			$count++;
			echo '</ul></div><div class="col-md-2"><ul><br>';
		}
		if ($i==ceil($limit/6)*$count) {
			$count++;
			echo '<div class="col-md-2"><ul><br>';
		}
		echo '<li><a class="footer-cats" href="/shop#'.$item[$i]->category.'"><span>'.$item[$i]->assoc.'</span></a></li>';
	}*/
?>