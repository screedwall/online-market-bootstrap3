<?php
	require_once $_SERVER["DOCUMENT_ROOT"]."/constants.php";
	session_start();
?>

<?php require $header; ?>

<script type="text/javascript">
	$(document).ready(function(){cart();});
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
						<h1>Корзина</h1>
					</div>
					<br>
					<div class="cart">
					<div class="row">
						<div class="panel panel-default">
						  <div class="panel-heading text-center">Товаров в корзине: <span id="current">0</span></div>
						  <div class="table-responsive">
							<table class="table table-striped table-responsive">
								<thead>
									<tr>
										<th>#</th>
										<th>Наименование</th>
										<th>Количество</th>
										<th>Цена</th>
										<th>На складе</th>
										<th>Действия</th>
									</tr>
								</thead>
								<tbody id="cart"></tbody>
							</table>
						</div>
					</div>
					</div>
					<div class="total text-right"></div>
					<div class="row text-right">
						<button class="btn btn-lg btn-success" onclick="$('#checkout').modal('show');">Оформить заказ</button>
					</div>
				</div>
				</div>
			</div>
	</div>
<?php require $footer; ?>

	<!-- Modal1 -->
<div class="modal fade" id="checkout" tabindex="-1" role="dialog" aria-labelledby="showItemLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="showItemLabel">Оформление заказа</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
        	<div class="row">
        		<div class="col-md-12">
        			<form id="order">
					  <div class="form-group">
					  	<label for="name">Имя <span class="mark">*</span>:</label>
					  	<br>
					    <input type="text" class="form-control" placeholder="Ваше имя" name="name">
						<br>
					    <label for="email">E-mail <span class="mark">*</span>:</label>
					  	<br>
					    <input type="text" class="form-control" placeholder="Ваш e-mail" name="email">
						<br>
					    <label for="phone">Телефон <span class="mark">*</span>:</label>
					  	<br>
					    <input type="text" class="form-control" placeholder="Ваш телефон" name="phone">
					  </div>
					</form>
					<div class="row text-center">
						<div class="btn-group btn-block" role="group">
							<button type="button" class="btn btn-half btn-lg btn-danger" data-dismiss="modal">Закрыть</button>
							<button type="submit" class="btn btn-half btn-lg btn-success" onclick="checkout(usrCart, $( '#order' ).serialize())">Оформить</button>
					</div>
					</div>
        		</div>
        </div>
      </div>
    </div>
  <div class="modal-footer">
    <p>Поля отмеченные <span class="mark">*</span> обязательны для заполнения</p>
  </div>
  </div>
</div>
</div>


	<!-- Modal2 -->
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
								<button class="btn btn-success" type="button" onclick="addToCart();cart();" id="cart-add-btn"><span class="add-to-cart">Добавить <i class="fas fa-cart-plus"></i></span></button>
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