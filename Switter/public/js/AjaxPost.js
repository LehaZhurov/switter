
var user = document.getElementsByClassName('User')[0]['id'];
function additionPost(id,content_raw,photo_post,time,user_id,img,name){
  var st1 = "<span class='post'>";
  var st2 = "<span class='post_header'>";
  var st3 = "<img src='"+img+"' alt=''><a href = '#"+id+"'></a><span class = 'user_name'><p><a href = 'http://switter/users/"+user_id+"'>"+name+"</a></p></span></span>";
  var st4 = "<span class='post_content'>";
  var st5 = "<img src='http://switter/public/storage/"+photo_post+"' alt=''>";
  var st6 = "<p>"+content_raw+"</p>";
  	if(user_id == user){
  		var st7 = "<span class = 'redact_post'><a href = 'http://switter/posts/"+id+"/edit'>Редактировать</a>"
  	}else{
  		var st7 = '';
  	}
  var st8 = "</span>";
  var st9 = "<span class='post_footer'><p>"+time+"</p><p><a href='#popup_comment' class = 'com_but' id = '"+id+"'>Коменнтари</a></p><p>3000 c</p>";
  var st10 = "</span></span>";

  return st1+st2+st3+st4+st5+st6+st7+st8+st9+st10;
  
}

function sendUserPost(){
 	let req,data,param;
 	param = document.querySelector("#userid").value;
 	if(param){
  		req = new XMLHttpRequest();
  		req.open("Get","/ajax/posts/"+param+"",true);
  		req.addEventListener('readystatechange',function(){
   			if((req.readyState == 4)&&(req.status == 200)){
  				let responce = req.responseText;
      			responce = JSON.parse(responce);
      			if(responce['data']){
      				for(let i = 0; i <=responce.lenght-1; i++){
        				let st = additionPost(
        						responce['data'][i]['id'],
                            	responce['data'][i]['content_raw'],
                            	responce['data'][i]['photo_post'],
                            	responce['data'][i]['publushed_at'],
                            	responce['data'][i]['user_id'],
                            	img = document.querySelector("#user_photo").src,
								name = document.querySelector("#name_user").innerHTML
                              				);
        				document.querySelector(".posts").innerHTML += st;
      				}	
      			}
   			}
		});
  		req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  		req.send();
  	}
 }
 sendUserPost();


