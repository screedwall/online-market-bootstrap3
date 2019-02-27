var check="";
var last_id=0;
var filename=0;
function getCommon(){
	$.ajax({
      type: 'POST',
      url: '/manager/getCommon.php',
      data: "pass="+password,
      success: function(data) {
      	var json=JSON.parse(data);
      	var html='<p><input type="text" id="email" value="'+json[1].email+'" name="email"></p>';
      	html+='<p><input type="text" id="phone" value="'+json[1].phone+'" name="phone"></p>';
      	html+='<p><button class="btn btn-success" onclick="changeCommon();" type="button">Изменить</button></p>';
      	$("#common").html(html);
      }
    });
}
function changeCommon(){
	var phone=encodeURIComponent($("#phone").val());
	var email=$("#email").val();
	$.ajax({
      type: 'POST',
      url: '/manager/changeCommon.php',
      data: "pass="+password+"&phone="+phone+"&email="+email,
      success: function(data) {
      	alert("Изменения сохранены");
      	getCommon();
      }
    }); 
}
function getOrders(){
	var html="";
	var buttons="";
	$("#orders-view").html(html);
	$.ajax({
      type: 'POST',
      url: '/manager/getOrders.php',
      data: "pass="+password,
      success: function(data) {
      	var json=JSON.parse(data);
      	var len=Object.keys(json).length;
      	for (var i = 1; i <= len; i++) {
      		if(json[i]==undefined){
      			len++;
      			continue;
      		}
      		html="";
      		if (json[i].status=="Утвержден") {
      			buttons="Заказ подтвержден<br><button onclick=\"showOrder('"+i+"')\" type='button' class='btn btn-default'>Подробнее</button> <button onclick=\"deleteOrder('"+i+"')\" type='button' class='btn btn-danger'>Удалить</button>";
      		}else{
      			buttons="<button onclick=\"showOrder('"+i+"')\" type='button' class='btn btn-default'>Подробнее</button> <button onclick=\"submitOrder('"+i+"')\" type='button' class='btn btn-success'>Подтвердить</button> <button onclick=\"deleteOrder('"+i+"')\" type='button' class='btn btn-danger'>Удалить</button>";
      		}
      		html+="<tr><td>"+i+"</td><td>"+json[i].timestamp+"</td><td><p>"+json[i].name+"</p><p>"+json[i].email+"</p><p>"+json[i].phone+"</p></td><td>"+json[i].sum+"</td><td>"+buttons+"</td></tr>";
      		$("#orders-view").append(html);
      	}
      }
    });
}
function deleteOrder(id){
	$.ajax({
      type: 'POST',
      url: '/manager/deleteOrder.php',
      data: "pass="+password+"&id="+id,
      success: function(data) {
      	getOrders();
      	alert("Удалено");
      }
    });
}
function submitOrder(id){
	$.ajax({
      type: 'POST',
      url: '/manager/submitOrder.php',
      data: "pass="+password+"&id="+id,
      success: function(data) {
      	getOrders();
      }
    });
}
function showOrder(id){
	var html="";
	$.ajax({
      type: 'POST',
      url: '/manager/showOrder.php',
      data: "pass="+password+"&id="+id,
      success: function(data) {
      	var json=JSON.parse(data);
      	$("#order-id").html(json.id);
      	$("#order-time").html(json.timestamp);
      	var userdata="<p>Имя: "+json.name+"</p><p>E-mail: "+json.email+"</p><p>Телефон: "+json.phone+"</p>";
      	$("#order-data").html(userdata);
      	$("#order-sum").html(json.sum);
      	$("#showOrder").modal("show");
      	json=JSON.parse(json.items_array);
      	$("#cart").html(html);
	      for (var i = 1; i < json.length; i++) {
	              html="";
	              if(json[i].img!=""){
	                image=json[i].img;
	              }else{
	                image="no-img.jpg";
	              }
	              html+="<tr><td>"+i+"</td><td><img style='max-width: 70px;max-height: 70px;' class='img-thumbnail cart-thumb' src='/img/upload/"+image+"''> "+json[i].name+"<p>ID Товара: "+json[i].id+"</p></td><td>"+json[i].value+" "+json[i].count+"</td><td>"+json[i].price+" руб.</td></tr>";
	              $("#cart").append(html);
	        }
      }
    });
}
function getCats(){
	var html="";
	$.ajax({
      type: 'POST',
      url: '/manager/getCats.php',
      data: "pass="+password,
      success: function(data) {
      	var json=JSON.parse(data);
      	check=json;
      	k=0;
      	for(var key in check){
			if(check[key].hasOwnProperty("id")==true){
				html="";
      			html+="<tr><td>"+json[key].category+"</td><td>"+json[key].assoc+"</td><td>"+json[key].gen_cat+"</td><td><button class='btn btn-default' onclick=\"(showCat('"+json[key].id+"','change'))\">Изменить</button> <button class='btn btn-danger' onclick=\"(removeCat('"+json[key].id+"'))\">Удалить</button></td></tr>";
	      		if(k==0){
	      			$("#categories-view").html(html);
	      		}else{
	      			$("#categories-view").append(html);
	      		}
	      		k++;
			}
		}
		last_id=parseInt(json[key].id)+1;
	}
   });
}
function showCat(id, flag){
	$(".category-modal").removeClass("invisible");
	$(".item-modal").addClass("invisible");
	$("#showCategory").modal("show");
	if(flag=="change"){
	$("#change-cat").removeClass("invisible");
	$("#add-cat").addClass("invisible");
	$.ajax({
      type: 'POST',
      url: '/manager/showCat.php',
      data: "pass="+password+"&id="+id,
      success: function(data) {
      	var json=JSON.parse(data);
      	$("#cat-id").val(json.id);
      	$("#cat-name").val(json.category);
      	$("#cat-assoc").val(json.assoc);
      	$("#cat-gen").val(json.gen_cat);
      }
    });
    }else if(flag=="add"){
    	$("#cat-id").val('Автоматически');
      	$("#cat-name").val('');
      	$("#cat-assoc").val('');
      	$("#cat-gen").val('');
		$("#change-cat").addClass("invisible");
		$("#add-cat").removeClass("invisible");
    }
	$("#showCategory").modal("show");
}
function changeCat(id,data){
	$.ajax({
      type: 'POST',
      url: '/manager/changeCat.php',
      data: "pass="+password+"&"+data+"&id="+id,
      success: function(data) {
      	alert("Изменено");
      }
    });
    showCat(id, "change");
}
function removeCat(id){
	$.ajax({
      type: 'POST',
      url: '/manager/removeCat.php',
      data: "pass="+password+"&id="+id,
      success: function(data) {
      	alert("Удалено");
      	getCats();
      }
    });
}
function addCategory(data){
	flag=0;
	check=data.split("&");
	for(key in check){
		check[key]=check[key].split("=");
		if(check[key][1]==""){flag=1};
	}
	if(flag!=1){
	$.ajax({
      type: 'POST',
      url: '/manager/addCategory.php',
      data: "pass="+password+"&"+data+"&id="+last_id,
      success: function(data) {
      	if(data!=""){
      		alert("Категория успешно добавлена");
      		$("#cat-name").val('');
      		$("#cat-assoc").val('');
      		$("#cat-gen").val('');
      		last_id++;
    		getCats();
      	}
      }
    });
	}else{
		alert("Нельзя оставлять поля пустыми");
	}
}
function getItems(){
	var html="";
	$.ajax({
      type: 'POST',
      url: '/manager/getItems.php',
      data: "pass="+password,
      success: function(data) {
      	var json=JSON.parse(data);
      	check=json;
      	k=0;
      	var json=JSON.parse(data);
      	check=json;
      	for(var key in check){
			if(check[key].hasOwnProperty("id")==true){
				html="";
				if(json[key].img==""){
					img="Нет картинки";
				}else{
					img='<a target="_blank" href="/img/upload/'+json[key].img+'">'+json[key].img+'</a>';
				}
      			html+="<tr><td>"+json[key].id+"</td><td>"+json[key].name+"</td><td>"+json[key].count+"</td><td>"+json[key].price+"</td><td>"+json[key].items_left+"</td><td>"+json[key].category+"</td><td>"+img+"</td><td><button class='btn btn-default' onclick=\"(showItem('"+json[key].id+"','change'))\">Изменить</button><button style='margin-top: 10px;' class='btn btn-danger' onclick=\"(removeItem('"+json[key].id+"'))\">Удалить</button></td></tr>";
	      		if(k==0){
	      			$("#items-view").html(html);
	      		}else{
	      			$("#items-view").append(html);
	      		}
	      		k++;
			}
		}
	}
   });
}
function showItem(id, flag){
	filename=0;
	$(".category-modal").addClass("invisible");
	$(".items-modal").removeClass("invisible");
	$("#showItem").modal("show");
	if(flag=="change"){
	$("#change-item").removeClass("invisible");
	$("#add-item").addClass("invisible");
	$.ajax({
      type: 'POST',
      url: '/manager/showItem.php',
      data: "pass="+password+"&id="+id,
      success: function(data) {
      	var json=JSON.parse(data);
      	$("#item-id").val(json.id);
      	$("#item-name").val(json.name);
      	$("#item-count").val(json.count);
      	$("#item-price").val(json.price);
      	$("#items_left").val(json.items_left);
      	$("#item-category").val(json.category);
      	$("#item-img").val(json.img);
      	if(json.img!=""){
      		filename=json.img;
      	}else{
      		filename=0;
      	}
      }
    });
    }else if(flag=="add"){
    	$("#item-id").val('Автоматически');
      	$("#item-name").val('');
      	$("#item-count").val('');
      	$("#item-price").val('');
    	$("#items_left").val('');
      	$("#item-category").val('');
      	$("#item-img").val('Автоматически');
		$("#change-item").addClass("invisible");
		$("#add-item").removeClass("invisible");
    }
	$("#showItem").modal("show");
}
function addItem(data){
	var args;
	flag=0;
	check=data.split("&");
	for(key in check){
		check[key]=check[key].split("=");
		if(check[key][1]==""){flag=1};
	}
	if(flag!=1){
	if(filename!=0){
		args="pass="+password+"&"+data+"&img="+filename;
	}else{
		args="pass="+password+"&"+data+"&img=";
	}
	$.ajax({
      type: 'POST',
      url: '/manager/addItem.php',
      data: args,
      success: function(data) {
      	if(data!=""){
      		alert("Товар успешно добавлен");
      		$("#item-name").val('');
      		$("#item-count").val('');
      		$("#item-price").val('');
      		$("#items_left").val('');
      		$("#item-category").val('');
      		$("#item-img").val('');
      		$("#file").val('');
      		filename=0;
    		getItems();
      	}
      }
    });
	
	}else{
		alert("Нельзя оставлять поля пустыми");
	}
}
function removeItem(id){
	$.ajax({
      type: 'POST',
      url: '/manager/removeItem.php',
      data: "pass="+password+"&id="+id,
      success: function(data) {
      	alert("Удалено");
      	getItems();
      }
    });
}
function changeItem(id, data){
	var args;
	flag=0;
	check=data.split("&");
	for(key in check){
		check[key]=check[key].split("=");
		if(check[key][1]==""){flag=1};
	}
	if(flag!=1){
	if(filename!=0){
		args="id="+id+"&pass="+password+"&"+data+"&img="+filename;
	}else{
		args="id="+id+"&pass="+password+"&"+data+"&img=";
	}
	$.ajax({
      type: 'POST',
      url: '/manager/changeItem.php',
      data: args,
      success: function(data){
      	if(data!=""){
      		alert("Товар успешно изменен");
      		filename=0;
    		getItems();
      	}
      }
    });
	
	}else{
		alert("Нельзя оставлять поля пустыми");
	}
}

$(document).ready(function(){
    getCommon();
});
$(document).ready(function() {
$('#upload-file').on('change', (function(e){
	e.preventDefault();
  	$.ajax({
		url: "file.php", // Url to which the request is send
		type: "POST",             // Type of request to be send, called as method
		data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
		contentType: false,       // The content type used when sending data to the server.
		cache: false,             // To unable request pages to be cached
		processData:false,        // To send DOMDocument or non processed data file it is set to false
		success: function(data)   // A function to be called if request succeeds
		{
			var json=JSON.parse(data);
			if(json.status=="success"){
				filename=json.filename;
				$("#item-img").val(filename);
			}else{
				filename=0;
			}
		}
	});
}));
});