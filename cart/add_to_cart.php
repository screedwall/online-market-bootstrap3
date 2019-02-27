<?php
    if(isset($_POST["id"])){
    session_start();
    $id=$_POST["id"];
    $count=$_POST["count"];
    $max_items=$_POST["items_left"];
    $response=[];
    $response["max"]=0;
    $flag=0;
    if($_SESSION["cart"]["current"]!=0){
    foreach ($_SESSION["cart"] as $key => $value) {
            if($id==$key){
                $flag=1;
                if ($count+$value>=$max_items){
                    $_SESSION["cart"][$id]=$max_items;
                    $response["msg"]="В корзине находится максимум товаров данного типа";
                    $response["max"]=1;
                }else{
                    $_SESSION["cart"][$id]+=$count;
                    $response["msg"]="Количество данных товаров было увеличено в вашей корзине";
                    break;
                }
            }
    }
    }
    if($flag==0){
        $_SESSION["cart"][$id]=$count;
        $_SESSION["cart"]["current"]++;
        $response["msg"]="Товар добавлен в корзину";
    }
    $response["value"]=$_SESSION["cart"][$id];
    $response["current"]=$_SESSION["cart"]["current"];
    echo json_encode($response);
}else{
    die("Несанкционированная попытка получения доступа");
}
?>