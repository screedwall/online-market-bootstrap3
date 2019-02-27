<?php
	require_once $_SERVER["DOCUMENT_ROOT"]."/constants.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Панель управления</title>
  	<script type="text/javascript" src=<?=$jquery?>></script>
  	<script type="text/javascript" src=<?=$bootstrap_js?>></script>
  	<script type="text/javascript" src="admin.js"></script>
  	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  	<link rel="stylesheet" href=<?=$bootstrap_css?>>
  	<link rel="stylesheet" href=<?=$fontawesome_css?>>
  	<link rel="stylesheet" href=<?=$bootstrap_theme_css?>>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="container text-center">
			<div class="login text-left">
				<br>
				<form action="/manager/" method="POST">
					<div class="form-group">
					    <label for="username">Имя пользователя: </label>
					    <input type="username" name="username" class="form-control" id="username" placeholder="Имя пользователя">
					</div>
					<div class="form-group">
					    <label for="password">Пароль: </label>
					    <input type="password" name="password" class="form-control" id="password" placeholder="Пароль">
					</div>
					<button class="btn btn-block btn-primary" type="submit">Войти</button>
				</form>
			</div>
			</div>
			<div class="manager" style="display:none;">

			  <!-- Nav tabs -->
			  <ul class="nav nav-tabs" role="tablist">
			    <li role="presentation" class="active"><a onclick="getCommon();" href="#common" aria-controls="common" role="tab" data-toggle="tab">Общая информация</a></li>
			    <li role="presentation"><a onclick="getOrders();" href="#orders" aria-controls="orders" role="tab" data-toggle="tab">Заказы</a></li>
			    <li role="presentation"><a onclick="getCats();" href="#categories" aria-controls="categories" role="tab" data-toggle="tab">Категории</a></li>
			    <li role="presentation"><a onclick="getItems();" href="#items" aria-controls="items" role="tab" data-toggle="tab">Товары</a></li>
			  </ul>

			  <!-- Tab panes -->
			  <div class="tab-content text-center">
			    <div role="tabpanel" class="tab-pane active" id="common"></div>
			    <div role="tabpanel" class="tab-pane" id="orders">
			    	<div class="table-responsive">
			    	<table class="table table-striped table-responsive">
			    		<thead>
			    			<tr>
			    				<td>ID Заказа</td>
			    				<td>Дата заказа</td>
			    				<td>Данные заказчика</td>
			    				<td>Сумма заказа</td>
			    				<td>Действия</td>
			    			</tr>
			    		</thead>
			    		<tbody id="orders-view" class="text-center"></tbody>
			    	</table>
			    	</div>
			    </div>
			    <div role="tabpanel" class="tab-pane" id="categories">
			    	<div class="table-responsive">
			    	<table class="table table-striped table-responsive">
			    		<thead>
			    			<tr>
			    				<td>Ссылка на категорию</td>
			    				<td>Категория</td>
			    				<td>Надкатегория</td>
			    				<td>Действия</td>
			    			</tr>
							<tr>
								<td colspan="4"><p><a href="#" onclick="showCat(0, 'add')"><i class="fas fa-2x fa-plus-square"> Добавить категорию</i></a><p></td>
							</tr>
			    		</thead>
			    		<tbody id="categories-view" class="text-center"></tbody>
			    	</table>
			    	</div>
			    </div>
			    <div role="tabpanel" class="tab-pane" id="items">
			    	<div class="table-responsive">
			    	<table class="table table-striped table-responsive">
			    		<thead>
			    			<tr>
			    				<td>ID товара</td>
			    				<td>Имя товара</td>
			    				<td>Еденица товара</td>
			    				<td>Цена</td>
			    				<td>Остаток на складе</td>
			    				<td>Ссылка на категорию</td>
			    				<td>Картинка</td>
			    				<td>Действия</td>
			    			</tr>
							<tr>
								<td colspan="8"><p><a href="#" onclick="showItem(0, 'add')"><i class="fas fa-2x fa-plus-square"> Добавить товар</i></a><p></td>
							</tr>
			    		</thead>
			    		<tbody id="items-view" class="text-center"></tbody>
			    	</table>
			    	</div>
			    </div>
			    </div>
			  </div>

			</div>
		</div>
	</div>
	<?php
			if (isset($_POST["username"])) {
				if(($_POST["username"]==$panel_user)&&(md5($_POST["password"])==md5($panel_pass))){
					echo '<script type="text/javascript">
							var password="'.md5($_POST["password"]).'";
						    $(".login").css("display", "none");
							$(".manager").css("display", "block");
						</script>';
				}
			}
	?>
<!-- Modal1 -->
<div class="modal fade" id="showOrder" tabindex="-1" role="dialog" aria-labelledby="showItemLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="showItemLabel">Информация о заказе</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
        	<div class="row">
        		<div class="col-md-12">
					<h3>ID Заказа: <span id="order-id"></span></h3>
					<h3>Дата Заказа: <span id="order-time"></span></h3>
					<h3><p>Данные заказчика: </p><span id="order-data"></span></h3>
					<h3>Сумма Заказа: <span id="order-sum"></span> руб.</h3>
					<h4>Данные заказа:</h4>
					<div class="table-responsive">
						<table class="table table-striped table-responsive">
								<thead>
									<tr>
										<th>#</th>
										<th>Наименование</th>
										<th>Заказано</th>
										<th>Цена</th>
									</tr>
								</thead>
								<tbody id="cart"></tbody>
							</table>
					</div>
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
<!-- Modal2 -->
<div class="modal fade" id="showCategory" tabindex="-1" role="dialog" aria-labelledby="showItemLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="showItemLabel">Редактирование категории</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
        	<div class="row">
        		<div class="col-md-12 category-modal">
					<h4>Редактирование категории</h4>
					<form method="POST" id="cat-form">
					<div class="row">
						<div class="col-md-3">
							<label for="cat-id">ID категории</label>
							<input type="text" name="cat-id" id="cat-id" disabled>
						</div>
						<div class="col-md-3">
							<label for="cat-name">Ссылка на категорию</label>
							<input type="text" id="cat-name" name="category">
						</div>
						<div class="col-md-3">
							<label for="cat-assoc">Название категории</label>
							<input type="text" id="cat-assoc" name="assoc">
						</div>
						<div class="col-md-3">
							<label for="cat-gen">Надкатегория</label>
							<input type="text" id="cat-gen" name="gen_cat">
						</div>
					</div>
					</form>
					<br>
        			<br>
        			<br>
        			<button id="change-cat" type="button" class="btn btn-success btn-block" onclick="changeCat($('#cat-id')	.val(),$('#cat-form').serialize());">Изменить категорию</button>
        			<button id="add-cat" type="button" class="btn btn-success btn-block" onclick="addCategory($('#cat-form'	).serialize());">Создать категорию</button>
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
<!-- Modal3 -->
<div class="modal fade" id="showItem" tabindex="-1" role="dialog" aria-labelledby="showItemLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="showItemLabel">Редактирование товара</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
        	<div class="container-fluid">
        	<div class="row">
        		<form method="POST" id="item-form">
	        		<div class="row">
	        		<div class="col-md-3">
						<label for="item-id">ID Товара</label>
	        			<input type="text" name="item-id" id="item-id" disabled>
	        		</div>
	        		<div class="col-md-3">
						<label for="item-name">Название</label>
	        			<input type="text" name="item-name" id="item-name">
	        		</div>
	        		<div class="col-md-3">
						<label for="item-count">Еденица товара</label>
	        			<input type="text" name="item-count" id="item-count">
	        		</div>
	        		<div class="col-md-3">
						<label for="item-price">Цена</label>
	        			<input type="text" name="item-price" id="item-price">
	        		</div>
	        		</div>
	        		<div class="row">
	        		<div class="col-md-3">
						<label for="items_left">Остаток на складе</label>
	        			<input type="text" name="items_left" id="items_left">
	        		</div>
	        		<div class="col-md-3">
						<label for="item-category">Ссылка на категорию</label>
	        			<input type="text" name="item-category" id="item-category">
	        		</div>
	        		<div class="col-md-3">
						<label for="item-img">Картинка</label>
	        			<input type="text" name="item-img" id="item-img" disabled>
	        		</div>
	        		</div>
				</form>
					<div class="col-md-3">
						<form id="upload-file" action="" method="post" enctype="multipart/form-data">
							<label for="file">Загрузить картинку</label>
	        				<input accept=".png, .jpg, .jpeg" type="file" name="file" id="file" onchange="">
	        			</form>
					</div>
				<br>
        		<br>
        		<br>
        		<button id="change-item" type="button" class="btn btn-success btn-block" onclick="changeItem($('#item-id').val(),$('#item-form').serialize());">Изменить товар</button>
        		<button id="add-item" type="submit" class="btn btn-success btn-block" onclick="addItem($('#item-form').serialize());">Создать товар</button>
        	</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>