let Ajax = false;
function additionUser(id,name,avatar,sub = "blue"){
	var st1 = "<span class='block_sub' id = '"+id+"'>"
	var st2 = "<img src='http://switter/public/storage/"+avatar+"'>"
	var st3 = "<span class='name_user'><a href='/users/"+id+"'><span>"+name+"</span></a></span>"
  if(sub == "red"){
    var st4 = "<span class='but "+id+"'><span class='sub' id = '"+id+"'>Подписан(а)</span></span>";
  }else{
	   var st4 = "<span class='but "+id+"'><button class='but_sub' id = '"+id+"'>Подписаться</button></span>"
  }
	var st5 = "</span>"

	return st1+st2+st3+st4+st5;
}
function sendUser(){
 	Ajax = true;
 	let req,data,param;
 	param = document.querySelector("#scroll_y").lastElementChild.id;
  	req = new XMLHttpRequest();
  	req.open("Get","/ajax/users/"+param+"",true);
  	req.addEventListener('readystatechange',function(){
   		if((req.readyState == 4)&&(req.status == 200)){
			let responce = req.responseText;
      		responce = JSON.parse(responce);
      		if(responce[0][0]){
      			for(let i = 0; i <=9; i++){
        			let st = additionUser(responce[0][i]['id'],
          			responce[0][i]['name'],
          			responce[0][i]['avatar'],
          			responce[0][i]['sub']
    			);
    			document.querySelector("#scroll_y").innerHTML += st;
        		if(i == 9){
        			Ajax = false;
          			sub_but();
          			unsub_but();
        		}
      		}
      	}
   	}
  });
  req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  req.send();
 }
sendUser();

document.querySelector("#scroll_y").addEventListener('scroll', function() {
  if(Ajax == false){
    sendUser();
  }
});


function subscrube(id){
  	let request,data;
  	request = new XMLHttpRequest();
  	request.open("Get","/ajax/users/sub/"+id+"",true);
  	request.addEventListener('readystatechange',function(){
   		if((request.readyState == 4)&&(request.status == 200)){
  			document.getElementsByClassName(id)[0].innerHTML = "<span class='but'><span class='sub "+id+"' id = "+id+">Подписан(а)</span></span>";
      		unsub_but();
   		}
  	});
  	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  	request.send();
}

function unsubscrube(id){
  	let request,data;
  	request = new XMLHttpRequest();
  	request.open("Get","/ajax/users/unsub/"+id+"",true);
  	request.addEventListener('readystatechange',function(){
   		if((request.readyState == 4)&&(request.status == 200)){
      		document.getElementsByClassName(id)[0].innerHTML = "<span class='but'><button class='but_sub' id = '"+id+"'>Подписаться</button></span>";
      		sub_but();
   		}
  	});
  	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  	request.send();
}


function sub_but(){
 	var img_zoom = document.querySelectorAll('.but_sub');
 	Array.from(img_zoom).forEach(function(button){
  		button.addEventListener('click', function(e) {
   			let id = e.target.id;
      		// subscrube(id);
      		console.log(id);
   			img_zoom = document.querySelectorAll('.but_sub');
  		})
 	});
}
sub_but();

function unsub_but(){
 	var img_zoom = document.querySelectorAll('.sub'); 
 	Array.from(img_zoom).forEach(function(button){
    	button.addEventListener('click', function(e) {
        	let id = e.target.id;
          	unsubscrube(id);
        	img_zoom = document.querySelectorAll('.sub');
  		})
 	});
}
unsub_but();
