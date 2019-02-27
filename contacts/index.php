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
				<h1>Контакты</h1>
				<h3><i style="color:#ff0000;" class="fas fa-map-marker"></i> Наш адрес: 423700, РТ, г. Мензелинск, ул. Октябрьская, 	д.6А</h3>
				<h3><a href="tel:<?=$phone?>"><i class="fas fa-phone"></i> Тел.: <?=$phone?></a></h3>
				<h3><a href="mailto:<?=$email?>"><i class="fas fa-at"></i> E-mail: <?=$email?></h3>
				<h3><a target="_blank" href="http://vk.com/krepej_menz"><i class="fab fa-vk"></i> vk.com/krepej_menz</a></h3>
				<br>
				<div class="table-responsive text-left">
					<iframe src="https://yandex.ru/map-widget/v1/-/CBqv66WZ3D" width="560" height="400" frameborder="0"></iframe>
				</div>
			</div>
		</div>
	</div>
	
	<?php require $footer; ?>