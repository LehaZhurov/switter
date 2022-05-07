let Ajax = false;
//Block
function ShablonPost(id,content_raw,photo_post,time,user_id,img,name){
	var user = document.getElementsByClassName('User')[0]['id'];
  	var st1 = "<span class='post'>";
  	var st2 = "<span class='post_header'>";
 	var st3 = "<img src='"+img+"' alt=''><a href = '#"+id+"'></a><span class = 'user_name'><p><a href = 'http://switter/user/"+user_id+"'>"+name+"</a></p></span></span>";
  	var st4 = "<span class='post_content'>";
  	var st5 = "<img src='/public/storage/"+photo_post+"' alt=''>";
  	var st6 = "<p>"+content_raw+"</p>";
  	if(user_id == user){
  		var st7 = "<span class = 'redact_post'><a href = 'http://switter/posts/"+id+"/edit'>Редактировать</a>"
  	}else{
  		var st7 = '';
  	}
  var st8 = "</span>";
  var st9 = "<span class='post_footer'><p>"+time+"</p><p><a href='#popup_comment' class = 'com_but' id = '"+id+"' onclick='Post("+id+")'>Коменнтари</a></p><p>3000 c</p>";
  var st10 = "</span></span>";

  return st1+st2+st3+st4+st5+st6+st7+st8+st9+st10;
}
function ShablonUser(id,name,avatar,sub = "blue"){
	var st1 = "<span class='block_sub' id = '"+id+"'>"
	var st2 = "<img src='http://switter/public/storage/"+avatar+"'>"
	var st3 = "<span class='name_user'><a href='/user/"+id+"'><span>"+name+"</span></a></span>"
  	if(sub == "red"){
    	var st4 = "<span class='but "+id+"'><button class='sub' id = '"+id+"'>Подписан(а)</button></span>";
  	}else{
	   	var st4 = "<span class='but "+id+"'><button class='but_sub' id = '"+id+"'>Подписаться</button></span>"
  	}
	var st5 = "</span>"
	return st1+st2+st3+st4+st5;
}

function ShabloComment(id,user_name,user_avatar,text,date,user_id){
	var st1 = "<span class='coment' id = '"+id+"'>"
	var st2 = "<img src='/public/storage/"+user_avatar+"' alt='' class='coment_form'>"
	var st3 = "<span class='text_coment'>"
	var st4 = "<p class='coment_name'><a href = '/user/"+user_id+"'>"+user_name+"</a>   <span class = 'com_date'>"+date+"</span></p>"
	var st5 = "<p class='text'>"+text+"</p>"
	var st6 = "</span>"
	var st7 = "</span>"
	return st1+st2+st3+st4+st5+st6+st7;
}
function load(param){
			document.getElementById('load').style.display = param;
}
//Inner block
function addittion(teg,inner){
	 document.querySelector(teg).innerHTML += inner;
	load('none');
	 
}
//Innew
function addittions(teg,inner,shug = inner.lenght){
	if(shug == 9){	
		for(let i = 0; i <= shug; i++){
			user = ShablonUser(inner[0][i]['id'],inner[0][i]['name'],inner[0][i]['avatar'],inner[0][i]['sub']);
			document.querySelector(teg).innerHTML += user;
		}
	}else{
		for(let i = 0; i <= shug-1; i++){
			post = ShablonPost(inner['data'][i]['id'],inner['data'][i]['content_raw'],inner['data'][i]['photo_post'],inner['data'][i]['publushed_at'],inner['data'][i]['user_id'],img = document.querySelector("#user_photo").src,name = document.querySelector("#name_user").innerHTML);
			document.querySelector(teg).innerHTML += post;
		}
	}
	load('none');
	
}
function additionBut(inner,id){
	document.getElementsByClassName(id)[0].innerHTML = inner;
	if(window.location.href.indexOf('http://switter/user/') != -1){
		unsub_but();
		sub_but();
	}
	load('none');

}
function additionComent(data){
	let poolcom = document.getElementById('pool_com');
	poolcom.innerHTML = "";
	for (var i = data[0].length - 1; i >= 0; i--) {
		poolcom.innerHTML += ShabloComment(data[0][i]['id'],data[0][i]['user_name'],data[0][i]['user_avatar'],data[0][i]['comment'],data[0][i]['publushed_at'],data[0][i]['user_id']);
	}
}
function CommentPost(data){
	document.getElementById('close_com').href = "#"+data['id'];
	document.getElementById('com_name').innerHTML = data['user_name'];
	document.getElementById('com_name').href = "/user/"+data['user_id'];
	document.getElementById('com_avatar').src = "http://switter/public/storage"+data['user_avatar'];
	document.getElementById('photo_com').src = "http://switter/public/storage/"+data['photo_post'];
	document.getElementById('text_com_poost').innerHTML = data['content_raw'];
	document.getElementById('date_com').innerHTML = data['publushed_at'];
	document.getElementById('id_post').value = data['id'];
}

//Ajax Request
function SendRequest(method,url,body = null){
	Ajax = true;
	load(true);
	return new Promise ((resolve,reject)=>{
		const xhr = new XMLHttpRequest();
		xhr.open(method,url)
		xhr.responseType = 'json';
		if(xhr.readyState == 0){
			load('block');
			console.log(0);
		}
		if(xhr.readyState == 1){
			load('block');
			console.log(1);
		}

		xhr.onload = () =>{
			if(xhr.status >= 400){
				reject(xhr.response);
				load('none');
			}else{
				resolve(xhr.response);
				Ajax = false;
			}
		}
		xhr.onerror = () =>{
			reject(xhr.response);
		}
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.send(body);
	});
}

function unsubscrube(id){
	document.getElementsByClassName(id)[0].innerHTML = "<button class='but_sub' id = '"+id+"'>Загрузка</button>"
	SendRequest("Get","/ajax/users/unsub/"+id+"",id)
	.then(data => additionBut("<button class='but_sub' id = '"+id+"'>Подписаться</button>",id))
	.catch(err => console.log(err));
}
function subscrube(id){
	document.getElementsByClassName(id)[0].innerHTML = "<button class='sub' id = '"+id+"'>Загрузка</button>"
	SendRequest("Get","/ajax/users/sub/"+id+"",id)
	.then(data => additionBut("<button class='sub' id = '"+id+"'>Подписан(а)</button>",id))
	.catch(err => console.log(err));
}
//ALL but subscrube
function sub_but(){
 	var sub = document.querySelectorAll('.but_sub');
 	Array.from(sub).forEach(function(button){
  		button.addEventListener('click', function(e) {
   			let id = e.target.id;
      		subscrube(id);
   			sub = document.querySelectorAll('.but_sub');
  		})
 	});
}
function unsub_but(){
 	var unsub = document.querySelectorAll('.sub'); 
 	Array.from(unsub).forEach(function(button){
    	button.addEventListener('click', function(e) {
        	let id = e.target.id;
          	unsubscrube(id);
        	unsub = document.querySelectorAll('.sub');
  		})
 	});
}
function CommentSend(){
	let form = document.getElementById('comment_from');
	console.log(form);
	SendRequest("Get","/ajax/comment/"+form[2].value+"/"+form[1].value+"");
	setTimeout(UploadComment(form[2].value),4000);


}
function UploadComment(id){
	load('none');
    document.getElementById('pool_com').innerHTML = "Загрузка";
	SendRequest("GET","/ajax/comment/"+id+"")
	.then(data => additionComent(data))
	.catch(err => console.log(err));
}
//One Post
function Post(param){
	SendRequest("GET","/ajax/posts/onepost/"+param+"")
	.then(data => CommentPost(data))
	.catch(err => console.log(err));
     setTimeout(UploadComment(param),0);
}
// // all button comments
// function com_but(){
//  	var com_but = document.querySelectorAll('.com_but'); 
//  	Array.from(com_but).forEach(function(button){
//     	button.addEventListener('click', function(e) {
//         	let id = e.target.id;
//       
//         	com_but = document.querySelectorAll('.com_but');
//         	Post(id);
//   		})
//  	});
// }
//News
function News(skip){
	SendRequest("GET","/ajax/posts/news/"+skip+"")
	.then(data => addittion('.content',ShablonPost(data[0]['id'],data[0]['content_raw'],data[0]['photo_post'],data[0]['publushed_at'],data[0]['user_id'],data[0]['user_photo'],data[0]['user_name']))
	)
	.catch(err => console.log(err));
	setTimeout(com_but(),0);
}
// Request Users
function Users(param){
	SendRequest("GET","/ajax/users/"+param+"")
	.then(data => addittions('#scroll_y',data,9))
	.catch(err => console.log(err));
	setTimeout(sub_but(),0);
	setTimeout(unsub_but(),0);
}
//Request User`s Posts
function UserPost(param){
	SendRequest("Get","/ajax/posts/"+param+"")
	.then(data => addittions('.posts',data))
	.catch(err => console.log(err));
	setTimeout(com_but(),0);
}

window.onload = function(){
    let skip,url_check,scroll_y,user_id; 
    skip = 20;
	url_check = window.location.href;
	if(url_check.indexOf('http://switter/news') != -1){
  		window.addEventListener('scroll', function() {
			if(Ajax == false){
				skip = skip +1;
				News(skip);
			}
		});
		for(let i = 10; i <= 20; i++){
			News(i);
		}
	}
	if(url_check.indexOf('http://switter/user/') != -1){
		user_id = document.querySelector("#userid").value;
		UserPost(user_id);
		sub_but()
		unsub_but()
	}
	if(url_check.indexOf('http://switter/users') != -1){
		document.querySelector('#scroll_y').addEventListener('scroll', function() {
			scroll_y = document.querySelector("#scroll_y").lastElementChild.id;
			if(Ajax == false){
				Users(scroll_y);
			}
		});
		Users(scroll_y);
	}

	

};

