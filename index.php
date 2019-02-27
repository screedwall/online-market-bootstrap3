<?php

require_once $_SERVER["DOCUMENT_ROOT"]."/constants.php";
?>



	<?php require $header; ?>
	<div class="container-fluid text-center">
		<div class="col-md-4 sidebar visible-lg visible-md">
			<div class="row">
				<div class="container-fluid">
					<?php require $sidebar;?>
 				</div>
			</div>
		</div>
		<div class="col-lg-8 col-md-8 text-left">
			<div class="row">
				<h1>О нас</h1>
				<h3 class="text-justify"><a href="/shop">Магазин «КрепЁж»</a> занимается продажей крепежа - одной из наиболее важных составляющих технологического процесса. Саморезы, шурупы, дюбели, анкеры, болты, гайки и шайбы, шпильки, такелаж, крепеж, перфорация - все эти категории товаров Вы можете приобрести в магазине. Также в продаже имеется всё для ремонта пластиковых окон.</h3>
			</div>

			<div class="row">
				<h2>Ознакомьтесь с некоторыми из <a href="/shop">товарами из нашего ассортимента</a></h2>
				<div class="row items text-center">
					<?php
						$item  = R::findAll( 'items', "NOT img = ?", [""]);
						$item=array_values($item);
						for($i=0;$i<8;$i++){
							$random=rand(1, (count($item)-1));
							echo '<div class="col-lg-3 col-md-4 col-xs-12 col-sm-6"><a class="thumbnail" href="#'.$item[$random]->category.'" onclick="getItem('.$item[$random]->id.');"><div><img class="img-thumbnail pic" src="/img/upload/'.$item[$random]->img.'" alt="Картинка"><div class="caption"><h5 class="item">'.$item[$random]->name.'</h5></div><h3><span class="label label-default">'.$item[$random]->price.' руб.</span></h3></div></a></div>';
						}
					?>
				</div>
			</div>

		</div>
	</div>
		<!-- Modal -->
<div class="modal fade" id="showItem" tabindex="-1" role="dialog" aria-labelledby="showItemLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="showItemLabel">Информация о товаре</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
        	<div class="row">
        		<div class="row">
        			<div class="col-md-12">
        				<ol class="breadcrumb text-left">
						  <li><a href="#" onclick="changeCategory('shop');">Каталог товаров</a></li>
						  <li class="active"><a class="breadcrumb-item" href="#"></a></li>
						</ol>
        				<h1><span id="item-name"></span></h1>
        			</div>
        		</div>
        		<div class="col-md-6">
        			<div class="thumbnail">
        				<img id="item-pic" src='' alt="Картинка">
        			</div>
        		</div>
        		<div class="col-md-6">
        			<span class="item-description"></span>
        			<h2>Цена: <span id="item-price"></span> руб.</h2>
        			<h3>Остаток на складе: <span id="item-left"></span> <span id="item-count"></span></h3>
        			<h3>ID товара: <span id="item-id"></span></h3>
        			<label for="basic-url" id="cart-add-msg">Добавить в корзину</label>
						<div class="input-group">
							<input type="number" value="1" class="form-control order-count" id="basic-url" aria-describedby="basic-addon3" max="" min="1">
							<span class="input-group-btn">
								<button class="btn btn-success" type="button" onclick="addToCart();" id="cart-add-btn"><span class="add-to-cart">Добавить <i class="fas fa-cart-plus"></i></span></button>
							</span>
						</div>
						<b><span id="cart-current-msg"></span></b>
        				<div id="response"></div>
        		</div>
        	</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>
	<?php require $footer; ?>