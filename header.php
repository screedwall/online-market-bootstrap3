<?php
  session_start();
  if( !isset( $_SESSION["cart"] ) ){
    $_SESSION["cart"]=['current' => '0'];
  }
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <script type="text/javascript" src=<?=$jquery?>></script>
  <script type="text/javascript" src=<?=$bootstrap_js?>></script>
  <script type="text/javascript" src=<?=$jqueryui_js?>></script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <link rel="stylesheet" href=<?=$bootstrap_css?>>
  <link rel="stylesheet" href=<?=$bootstrap_theme_css?>>
  <link rel="stylesheet" href=<?=$style?>>
  <link rel="stylesheet" href=<?=$jqueryui_css?>>
  <link rel="stylesheet" href=<?=$fontawesome_css?>>
  <title>Main</title>
  <script type="text/javascript" src=<?=$script?>></script>
</head>
<body>
  
  <div class="container-fluid">
    <div class="row">
      <div class="navbar navbar-default">
        <div class="container">
          <div class="navbar-header">
            <a href="/" class="navbar-brand">Главная</a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#responsive-menu">
              <span class="sr-only">Открыть навигацию</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
          <div class="collapse navbar-collapse" id="responsive-menu">
            <ul class="nav navbar-nav">
              <li><a href="/shop/">Каталог товаров</a></li>
              <li><a href="/contacts/">Контакты</a></li>
              <li><a href="/cart/"><i class="fas fa-shopping-cart"></i> Корзина <span class="badge" id="cart-counter">0</span></a></li>
              <li>
              <form class="navbar-form navbar-right form-1" method="POST">
                <div class="form-group text-right">
                  <div class="input-group">
                  <input type="text" class="form-control search-input" name="query" placeholder="Поиск товаров">
                  <span class="input-group-btn">
                  <button type="submit" class="btn btn-default search-btn" onclick="searchItems($('.form-1').serialize(), 0 ,10);"><i class="fas fa-search fa-lg"></i></button>
                  </span>
                </div>
                </div>
              </form>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  

