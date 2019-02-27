<?php
	require_once $_SERVER["DOCUMENT_ROOT"]."/constants.php";
	
	/*if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}*/
	session_start();
	

?>

	<?php require $header; ?>

	<div class="script">
		<div class="hiddenMin"></div>
		<div class="hiddenMax"></div>
	</div>
		<div class="container-fluid text-center">
			<div class="col-md-4 sidebar visible-lg visible-md">
				<div class="row">
					<div class="container-fluid">
						<?php require $sidebar;?>
 					</div>
				</div>
					
			</div>
			<div class="col-lg-8 col-md-8">

				<div class="content container-fluid">
					<div class="row">
					<ol class="breadcrumb text-left">
					  <li><a href="#" onclick="changeCategory('shop');">Каталог товаров</a></li>
					  <li class="active breadcrumb-category"></li>
					</ol>
					<h1 class="text-left">Каталог товаров</h1>
					<h2 class="text-left">Категория: <span class="item-category"></span></h2>
					<h3 class="category-description"></h3>
					<div class="count_limiter text-left">
						<h4>
						Выводить по: 
						<a href="#" onclick="freshItems(12, category);">12</a>
						<a href="#" onclick="freshItems(18, category);">18</a>
						<a href="#" onclick="freshItems(24, category);">24</a>
						товаров
						</h4>
					</div>
					<br>
					<div class="col-md-3 price_filter text-left">
						<h4>
						  <label for="amount">Диапазон цен: </label>
						  <input type="text" id="amount" readonly style="border:0; color:#ссс; font-weight:bold;">
						</h4>
						<p>
							<div id="price-range"></div><br>
								<div class="btn-group" role="group">
									<button class="btn btn-primary" onclick="freshItems(parts, category);">Искать</button>
									<button class="btn btn-default" onclick="location.reload();">Сбросить</button>
								</div>
						</p>
					</div>
					</div>
					<br>

					<div class="row items"></div>
					<div class="row">
						<div id="end-searching"></div>
					</div>
					<div class="row">
						<button class="get-btn btn btn-primary btn-block" onclick="getItems(parts, category);">Показать ещё</button>
					</div>
					<br>
					<br>
					<br>
					<br>
					<br>
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