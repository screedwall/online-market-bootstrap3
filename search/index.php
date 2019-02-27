<?php
	require_once $_SERVER["DOCUMENT_ROOT"]."/constants.php";
	session_start();
?>

<?php require $header; ?>

<script type="text/javascript">
	$(document).ready(function(){
		if(location.hash.substr(1)!=""){
		searchItems(location.hash.substr(1), current, parts);
	}else{
		searchItems("query=", current , parts);
	}
	});
</script>

<div class="container-fluid text-center">
			<div class="col-md-4 sidebar visible-lg visible-md">
				<div class="row">
					<div class="container-fluid">
						<?php require $sidebar;?>
 					</div>
				</div>
					
			</div>
			<div class="col-lg-8 col-md-8">
				<div class="content container-fluid text-left">
					<div class="row">
						<h1>Поиск по товарам</h1>
					</div>
					<div class="row search-form">
						<div class="search-form text-center">
						<form class="form-2" method="POST">
			                <div class="form-group text-right">
			                  <div class="input-group">
			                  <input type="text" class="form-control search-input" name="query" placeholder="Поиск товаров">
			                  <span class="input-group-btn">
			                  <button type="submit" class="btn btn-default search-btn" onclick="searchItems($('.form-2').serialize(), 0 ,parts);"><i class="fas fa-search fa-lg"></i></button>
			                  </span>
			                </div>
			                </div>
			              </form>
			            </div>
					</div>
						<div id="nothing"></div>
					<div class="row text-center" id="search-result">
					</div>
					<div id="end-searching"></div>
					<div class="row">
						<button class="get-btn btn btn-primary btn-block" onclick="searchItems(location.hash.substr(1), current, parts);">Показать ещё</button>
					</div>
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
        			<ol class="breadcrumb text-left">
						  <li><a href="#" onclick="changeCategory('shop');">Каталог товаров</a></li>
						  <li class="active"><a class="breadcrumb-item" href="#"></a></li>
						</ol>
        			<div class="col-md-12">
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