// Подгрузка постов в новости 
function NewsUpload(skip){
  let req,data;
      req = new XMLHttpRequest();
      req.open("Get","/ajax/posts/news/"+skip,true);
      req.addEventListener('readystatechange',function(){
        if((req.readyState == 4)&&(req.status == 200)){
          let responce = req.responseText;
              // responce = JSON.parse(responce);
              // let st = additionPost(
              //     responce[0]['id'],
              //               responce[0]['content_raw'],
              //               responce[0]['photo_post'],
              //               responce[0]['publushed_at'],
              //               responce[0]['user_id'],
              //               responce[0]['user_photo'],
              //               responce[0]['user_name']
              //                     );
              // document.getElementById('news_ul').innerHTML += st;
        }
    });
    req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    req.send();
}
let skip = 10;
window.addEventListener('scroll', function() {
  skip = skip +1;
  NewsUpload(skip);

});
alert('Work');
