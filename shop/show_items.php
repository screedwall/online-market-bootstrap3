<?php
	if(isset($_POST["count"])){
	require_once $_SERVER["DOCUMENT_ROOT"]."/constants.php";
	
	$count=$_POST["count"];
	$current=$_POST["current"];
	$fresh=$_POST["fresh"];
	$price0=$_POST["price0"];
	$price1=$_POST["price1"];
	$category=$_POST["category"];
	if(!$current){$current=0;}
	$k=0;
	if($fresh){
		echo '<script>$(".get-btn").show();</script>';
	}
	if($category!="shop"){
		if($price0==$price1){
			$price=$price1;
			$item  = R::find( 'items', "price = $price AND category LIKE ?", ["$category"]);
			$item=array_values($item);
		}else{
			$item  = R::findAll( 'items', " price >= $price0 AND price <= $price1 AND category LIKE ?", ["$category"]);
			$item=array_values($item);
		}
		$limit=count($item);
		for($i=$current;$i<$count+$current&&$i<$limit;$i++){
		if($item[$i]->img!=""){
			$image=$item[$i]->img;
		}else{
			$image="no-img.jpg";
		}
		echo '<div class="col-lg-3 col-md-4 col-xs-12 col-sm-6"><a class="thumbnail" href="#'.$category.'" onclick="getItem('.$item[$i]->id.');"><div><img class="img-thumbnail pic" src="/img/upload/'.$image.'" alt="Картинка"><div class="caption"><h5 class="item">'.$item[$i]->name.'</h5></div><h3><span class="label label-default">'.$item[$i]->price.' руб.</span></h3></div></a></div>';
		}
		if ($i>=$limit) {
		echo '<script>$(".get-btn").hide();$("#end-searching").html("<h2>Конец списка</h2>");</script>';
		}
	}else{
		$item  = R::findAll('items');
		$item=array_values($item);
		$limit=count($item);

		for($i=$current;$i<$count+$current&&$i<$limit;$i++){
		$random=rand(1, $limit-1);
		if($item[$random]->img!=""){
			$image=$item[$random]->img;
		}else{
			$image="no-img.jpg";
		}
		echo '<div class="col-lg-3 col-md-4 col-xs-12 col-sm-6"><a class="thumbnail" href="#'.$category.'" onclick="getItem('.$item[$random]->id.');"><div><img class="img-thumbnail pic" src="/img/upload/'.$image.'" alt="Картинка"><div class="caption"><h5 class="item">'.$item[$random]->name.'</h5></div><h3><span class="label label-default">'.$item[$random]->price.' руб.</span></h3></div></a></div>';
		}
		if ($i>=$limit) {
		echo '<script>$(".get-btn").hide();$("#end-searching").html("<h2>Конец списка</h2>");</script>';
		}
	}
	
	echo "<script>current=".$i."</script>";
	//<p>На складе: '.$item[$i]->items_left.'</p>  
	}else{
		die("Несанкционированная попытка получения доступа");
	}
?>
