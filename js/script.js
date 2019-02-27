  $(document).ready(function(){
    $('.form-1').submit(function () {return false;});
    $('.form-2').submit(function () {return false;});
  });
  document.title="Интернет-магазин \"КрепЁж\"";
  var current=0;
  var parts=12;
  var check="";
  var check2="";
  var usrCart="";
  var category=location.hash.substr(1);
  var minimum;
  var maximum;
$(function(){
  var matches={0:''};
  var k=1;
  var flag=0;
   $.ajax({
     type: 'POST',
     url: '/shop/categories.php',
     success: function(data) {
       var json=JSON.parse(data);
       for(jkey in json){
         for(ikey in matches){
            if(matches[ikey]==json[jkey].gen_cat){
              $("ul#"+ikey).append('<li><a id="category" onclick="changeCategory(\''+json[jkey].category+'\')" href="#'+json[jkey].category+'">'+json[jkey].assoc+'</a></li>');
              flag=1;
              break;
            }else{flag=0;}
         }
         if(flag==0){
          matches[k]=json[jkey].gen_cat;
          $("#accordion").append('<div class="panel panel-default"><div class="panel-heading"><h4 class="panel-title"><a href="#collapse-'+k+'" data-parent="#accordion" data-toggle="collapse">'+json[jkey].gen_cat+'</a></h4></div><div id="collapse-'+k+'" class="panel-collapse collapse"><div class="panel-body"><ul id="'+k+'"><li><a id="category" onclick="changeCategory(\''+json[jkey].category+'\')" href="#'+json[jkey].category+'">'+json[jkey].assoc+'</a></li></ul></div></div></div>');
          k++;
          }
       }
     }
   });
 }
);
  function getItems(count, category){
      $.ajax({
      type: 'POST',
      url: '/shop/show_items.php',
      data: "category="+category+"&count="+count+"&current="+current+"&fresh="+0+"&price0="+$( "#price-range" ).slider( "values", 0 )+"&price1="+$( "#price-range" ).slider( "values", 1 ),
      success: function(data) {
          $('.items').append(data);
          cartNum();
        }
    }); 
  }
  function getItem(id){
      $.ajax({
      type: 'POST',
      url: '/shop/show_item.php',
      data: "id="+id,
      success: function(data) {
          var json=JSON.parse(data);
          if(json.img!=""){
            $("#item-pic").attr("src", "/img/upload/"+json.img);
          }else{
            $("#item-pic").attr("src", "/img/upload/no-img.jpg");
          }
          $(".breadcrumb-item").attr("onclick", "changeCategory('"+json.category+"')");
          $("#item-id").html(json.id);
          $("#item-price").html(json.price);
          $("#item-left").html(json.items_left);
          $("#item-count").html(json.count);
          $("#item-name").html(json.name);
          $(".order-count").val(1);
          $(".order-count").attr("max", json.items_left);
          $('#response').html('');
          $('#showItem').modal('show');
          $("#cart-add-btn").prop("disabled", null);
          cartInfo();
          $.ajax({
          type: 'POST',
          url: '/shop/itemcat.php',
          data: "category="+json.category,
          success: function(data) {
              $(".breadcrumb-item").text(data);
            }
        });
        }
    });
      
  }

  function addToCart(){
    $.ajax({
      type: 'POST',
      url: '/cart/add_to_cart.php',
      data: "id="+$("#item-id").text()+"&count="+$(".order-count").val()+"&items_left="+$("#item-left").text(),
      success: function(data) {
        var json=JSON.parse(data);
        cartNum();
        $("#response").html(json.msg);
        $("#cart-current-msg").text('В корзине '+json.value+" "+$("#item-count").text());
        if(json.max==1){
          $("#cart-add-btn").prop("disabled", true)
        }
      }
    });
  }
  function cartInfo(){
    $.ajax({
      type: 'POST',
      url: '/cart/cart_info.php',
      data: "id="+$("#item-id").text(),
      success: function(data) {
        if(data!="[]"){
          var json=JSON.parse(data);
          $("#cart-current-msg").text('В корзине '+json.value+" "+$("#item-count").text());
          cartNum();
        }else{
          $("#cart-current-msg").text('');
          }
      }
    });
  }
  function cartNum(){
    $.ajax({
      type: 'POST',
      url: '/cart/cart_num.php',
      success: function(data) {
        if(data!="[]"){
          $("#cart-counter").text(data);
        }
      }
    });
  }
  function freshItems(count, category){
      if(typeof($( "#price-range" ).slider( "values", 0 ))=="object"){
        var price0=0;
        var price1=1;
      }else{
        var price0=$( "#price-range" ).slider( "values", 0 );
        var price1=$( "#price-range" ).slider( "values", 1 );
      }
      $("#end-searching").html("");
      current=0;
      parts=count;
      $.ajax({
      type: 'POST',
      url: '/shop/show_items.php',
      data: "category="+category+"&count="+count+"&fresh="+1+"&price0="+price0+"&price1="+price1,
      success: function(data) {
          $('.items').html(data);
        }
    }); 
  }


function priceRange(){
    $.ajax({
      type: 'POST',
      url: '/shop/show_items.php',
      data: "count="+count+"&fresh="+1,
      success: function(data) {
          $('.items').html(data);
        }
    }); 
}
function removeItem(id){
    $.ajax({
      type: 'POST',
      url: '/cart/remove.php',
      data: "id="+id,
      success: function(data) {
          cart();
          cartNum();
          return "Удалено";
        }
    }); 
}
function cart(){
$.ajax({
    type: 'POST',
    url: '/cart/get_cart.php',
    success: function(data) {
    usrCart=data;
    var json=JSON.parse(data);
    var html="";
    if(json[0].current!=0){
    var sum=0;
    cartNum();
    $("#current").text(json[0].current);
    $("#cart").html(html);
      for (var i = 1; i < json.length; i++) {
              html="";
              if(json[i].img!=""){
                image=json[i].img;
              }else{
                image="no-img.jpg";
              }
              sum+=parseFloat(json[i].price)*json[i].value;
              html+="<tr><td>"+i+"</td><td><a href='#"+json[i].id+"'' onclick='getItem("+json[i].id+")'><img class='img-thumbnail cart-thumb' src='/img/upload/"+image+"''> "+json[i].name+"</a><p>ID Товара: "+json[i].id+"</p></td><td>"+json[i].value+" "+json[i].count+"</td><td>"+json[i].price+" руб.</td><td>"+json[i].items_left+" "+json[i].count+"</td><td><button class='btn btn-danger' onclick='removeItem("+json[i].id+")'>Удалить</button></td></tr>";
              $("#cart").append(html);
        }
        $(".total").html("<h2>Итого: <span id='sum'>"+sum.toFixed(2)+"</span> руб.<h2>");
      }else{
        html="<h3>Ваша корзина пуста. Посмотрите товары в <a href='/shop'>каталоге</a> и добавьте что-нибудь в корзину.</h3>";
        $(".cart").html(html);
        cartNum();
        $("#current").text(json[0].current);
      }
      }
    });
}
function checkout(cart, user){
  user='&'+user;
  var sum=$("#sum").text();
  $.ajax({
      type: 'POST',
      url: '/cart/checkout.php',
      data: "cart="+cart+user+"&sum="+sum,
      success: function(data) {
        alert(data);
      },
      error: function(data) {
        alert(data);
      }
      });
}

function changeCategory(cat){
  if(location.href.split('/')[3]!="shop"){
    window.location.replace("/shop/#"+cat);
  }
    document.title="Интернет-магазин \"КрепЁж\"";
    if(cat!=""&&cat!="shop"){
      $(".price_filter").css("display", "block");
      category=cat;
    }else{
      $(".price_filter").css("display", "none");
      category="shop";
      cat="shop";
    }
    $.ajax({
      type: 'POST',
      url: '/shop/minmax.php',
      data: "category="+cat,
      success: function(data) {
        var json=JSON.parse(data);
        $(".hiddenMin").text(json.min);
        $(".hiddenMax").text(json.max);
        $( "#price-range" ).slider({
          range: true,
          min: Number($(".hiddenMin").text()),
          max: Number($(".hiddenMax").text()),
          values: [ Number($(".hiddenMin").text()), Number($(".hiddenMax").text()) ],
          slide: function( event, ui ) {
            $( "#amount" ).val( ui.values[ 0 ]+"руб." + " - " + ui.values[ 1 ]+"руб." );
          }
          });
          $( "#amount" ).val( $( "#price-range" ).slider( "values", 0 )+ "руб."+" - " + $( "#price-range" ).slider( "values", 1 )+"руб." );
      freshItems(parts, category);
    }
  });
    if(cat!=""&&cat!="shop"){
  category=cat;
  $.ajax({
      type: 'POST',
      url: '/shop/get_cats.php',
      data: "category="+cat,
      success: function(data) {
        var json=JSON.parse(data);
        $(".item-category").html(json.assoc);
        var sidebar = $("#accordion div.panel-heading a");
        for(i=0;i<sidebar.length;i++){
          if($("#accordion div.panel-heading a")[i].text==json.gen_cat){
            $("#collapse-"+(i+1)).collapse('toggle');

            $(".breadcrumb-category").text(json.assoc);

            document.title+=" | "+json.assoc;
          }
        }
      }
      });
}else{
  category="shop";
  $(".item-category").html("Случайные");
  $(".price_filter").css("display", "none");
  $(".breadcrumb-category").text("Случайные");
  document.title+=" | Случайные";
}
    return cat;
}

function searchItems(query, current1, count){
  if(query!="query="){
    location.replace("#"+query);
    if(location.href.split('/')[3]=="search"){
      $.ajax({
        type: 'POST',
        url: '/search/search.php',
        data: query+"&current="+current1+"&count="+count,
        success: function(data) {
          if(current1==0){
          $("#end-searching").html("");
          current=0;
          $(".get-btn").show();
          $("#search-result").html(data);
          if(current!=0){
            $("#nothing").html("");
          }else{
            $("#nothing").html("<h3>К сожалению ничего не найдено. Попробуйте выполнить другой запрос</h3>");
            $("#search-result").html(data);
            $(".get-btn").hide();
        }}else{
          $(".get-btn").show();
          $("#search-result").append(data);
          if(current!=0){
            $("#nothing").html("");
          }else{
            $("#nothing").html("<h3>К сожалению ничего не найдено. Попробуйте выполнить другой запрос</h3>");
            $("#search-result").html(data);
            $(".get-btn").hide();
        }
        }
        }
        });
    }else{
      window.location.replace("/search/#"+query);
    }
  }else{
    $("#search-result").html("");
    alert("Нельзя выполнить пустой запрос");
    $("#nothing").html("<br><h4 style='color:#ff0000'>Пустой поисковой запрос не может быть выполнен</h4>");
    $(".get-btn").hide();
  }
}

$(document).ready(function(){
    if(location.href.split('/')[3]=="shop"){
      changeCategory(location.hash.substr(1));
    }
    cartNum();
});