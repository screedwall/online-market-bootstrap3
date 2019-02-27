<?php
	if(isset($_POST["query"])){
		require_once $_SERVER["DOCUMENT_ROOT"]."/constants.php";
		
		$count=$_POST["count"];
		$current=$_POST["current"];
		$query=$_POST["query"]."%";
		$item=R::find( 'items', ' name LIKE ? ', [ "$query" ] );
		$item=array_values($item);
		$limit=count($item);
		for($i=$current;$i<$count+$current&&$i<$limit;$i++){
		if($item[$i]->img!=""){
			$image=$item[$i]->img;
		}else{
			$image="no-img.jpg";
		}
		echo '<div class="col-lg-3 col-md-4 col-xs-12 col-sm-6"><a href="#'.$category.'" onclick="getItem('.$item[$i]->id.');"><div class="thumbnail"><img class="img-thumbnail pic" src="/img/upload/'.$image.'" alt="Картинка"><div class="caption"><h5 class="item">'.$item[$i]->name.'</h5></div><h3><span class="label label-default">'.$item[$i]->price.' руб.</span></h3></div></a></div>';
		}
		if ($i>=$limit) {
		echo '<script>$("#end-searching").html("<h2>Конец поиска</h2>");$(".get-btn").hide();</script>';
		}
		echo "<script>current+=$i</script>";
	}
?>