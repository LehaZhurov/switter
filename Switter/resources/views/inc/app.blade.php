<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}" id = "csrf">
	<title>@yield('title')</title>
	<link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
</head>
<body>
    <canvas id = "canvas"></canvas>
	<div id="work_obl">
	<load id = "load"> <img src="{{ asset('/public/storage/images/load.gif') }}" alt=""></load>
	@if($errors->any())
	<span id="error_block">
	    <span>
	    	@foreach($errors->all() as $mess)
	    		<p class = "error"> {{ $mess }} </p>
	    	@endforeach
	    </span>
	</span>
    @endif 
    @if(session('error'))
	<span id="error_block">
	    <span>
	    	<p class = "error"> {{ session('error') }} </p>
	    </span>
	</span>
    @endif
    @if(session('success'))
	<span id="error_block">
	    <span>
	    	<p class = "good"> {{ session('success') }} </p>
	    </span>
	</span>
    @endif 
    @if(session('danger'))
	<span id="error_block">
	    <span>
	    	<p class = "danger"> {{ session('danger') }} </p>
	    </span>
	</span>
    @endif
    
		@yield('content')
	
	</div>
    
</body>
<span id="popup" class = 'popup'>
	<span class="popup_body">
		<span class = "popup_content"> 
			<h1 class="h">Добавить запись</h1>
			<a class="popup_close" href = "#">X</a>
			<form action="{{route('social.posts.store')}}" class ="popup_form" enctype="multipart/form-data" method="post"> 
				@csrf
				<label for="text_post">Техт записи</label>
    			<textarea type="text" class="input_form" name = "text_post"></textarea>
    			<label for="images_post">Прикрепить файл</label>
    			<input type="file" class="input_form" name = "images_post">
    			<button class = "but_sub">Опубликовать</button>
			</form >
		</span>
	</span>
</span>
<span id="popup_comment" class = 'popup_comment'>
	<span class="popup_comment_body">
		<span class = "popup_comment_content"> 
			<a class="popup_comment_close" href = "#" id = 'close_com'>X</a>
		<span class='post comment_post'>
  			<span class='post_header'>
  				<img src='http://switter/public/storage/images/F0oTo6QsjIWxPL0z3OqM2YaTJuMIIfbko2WR3rEH.jpeg' alt='' id = "com_avatar"><span class = 'user_name'><p><a id = "com_name"href = 'http://switter/users/100'>TEST User</a></p></span>
  			</span>
  			<span class='post_content'>
  				<img id = "photo_com"src='http://switter/public/storage/images/izubIecUoCTlvLHoCb8RlPkiu5ca23e0Ki0iLnJC.jpeg' alt=''>
  				<p id = "text_com_poost">lalalalalal alalalal ala lalala la alala la lal ala al alalalalal ala la ala llllaallalalalalala</p>
  			</span>
  			<span class='post_footer'>
  				<p id = "date_com">07.27.2023/10.51.19</p><p>3000 c</p>
  			</span>
  		</span>
		<h1 class="h">Добавить Комменатрий</h1>
		<form class ="popup_comment_form" enctype="multipart/form-data"  id = "comment_from"> 
			@csrf
			<label for="text_post">Комменатрий</label>
    		<textarea type="text" class="input_form" name = "text_comment" required=""></textarea>
    		<input type="text" name = 'id_post' id = 'id_post'>
    		<button onclick="CommentSend()" id = 'com_but' type = 'button' >Опубликовать</button>
    	</form>
		<span id = "obolochka_com">
		<span class = "scroll_y" id = "pool_com">
			<span class="coment">
				<img src="http://switter/public/storage/images/izubIecUoCTlvLHoCb8RlPkiu5ca23e0Ki0iLnJC.jpeg" alt="" class="coment_form">
				<span class="text_coment">
					<p class="coment_name">Имя пользователя <span class = "com_date">07.27.2023/10.51.19</span></p>
					<p class="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis odio, voluptatum perspiciatis, neque tempore magnam possimus nemo pariatur ex qui sed, aliquam, maiores expedita atque deserunt animi? Repellat eius, pariatur.</p>
				</span>
			</span>
			<span class="coment">
				<img src="http://switter/public/storage/images/izubIecUoCTlvLHoCb8RlPkiu5ca23e0Ki0iLnJC.jpeg" alt="" class="coment_form">
				<span class="text_coment">
					<p class="coment_name">Имя пользователя <span class = "com_date">07.27.2023/10.51.19</span></p>
					<p class="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis odio, voluptatum perspiciatis, neque tempore magnam possimus nemo pariatur ex qui sed, aliquam, maiores expedita atque deserunt animi? Repellat eius, pariatur.</p>
				</span>
			</span>
			<span class="coment">
				<img src="http://switter/public/storage/images/izubIecUoCTlvLHoCb8RlPkiu5ca23e0Ki0iLnJC.jpeg" alt="" class="coment_form">
				<span class="text_coment">
					<p class="coment_name">Имя пользователя <span class = "com_date">07.27.2023/10.51.19</span></p>
					<p class="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis odio, voluptatum perspiciatis, neque tempore magnam possimus nemo pariatur ex qui sed, aliquam, maiores expedita atque deserunt animi? Repellat eius, pariatur.</p>
				</span>
			</span>
			<span class='coment'>
				<img src='/public/storage/' alt='' class='coment_form'>
				<span class='text_coment'>
					<p class='coment_name'>----<span class = 'com_date'>----</span></p>
					<p class='text'></p>
				</span>
			</span>
			<span class="coment">
				<img src="http://switter/public/storage/images/izubIecUoCTlvLHoCb8RlPkiu5ca23e0Ki0iLnJC.jpeg" alt="" class="coment_form">
				<span class="text_coment">
					<p class="coment_name">Имя пользователя <span class = "com_date">07.27.2023/10.51.19</span></p>
					<p class="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis odio, voluptatum perspiciatis, neque tempore magnam possimus nemo pariatur ex qui sed, aliquam, maiores expedita atque deserunt animi? Repellat eius, pariatur.</p>
				</span>
			</span>
			<span class="coment">
				<img src="http://switter/public/storage/images/izubIecUoCTlvLHoCb8RlPkiu5ca23e0Ki0iLnJC.jpeg" alt="" class="coment_form">
				<span class="text_coment">
					<p class="coment_name">Имя пользователя <span class = "com_date">07.27.2023/10.51.19</span></p>
					<p class="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis odio, voluptatum perspiciatis, neque tempore magnam possimus nemo pariatur ex qui sed, aliquam, maiores expedita atque deserunt animi? Repellat eius, pariatur.</p>
				</span>
			</span>
			<span class="coment">
				<img src="http://switter/public/storage/images/izubIecUoCTlvLHoCb8RlPkiu5ca23e0Ki0iLnJC.jpeg" alt="" class="coment_form">
				<span class="text_coment">
					<p class="coment_name">Имя пользователя <span class = "com_date">07.27.2023/10.51.19</span></p>
					<p class="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis odio, voluptatum perspiciatis, neque tempore magnam possimus nemo pariatur ex qui sed, aliquam, maiores expedita atque deserunt animi? Repellat eius, pariatur.</p>
				</span>
			</span>
			<span class="coment">
				<img src="http://switter/public/storage/images/izubIecUoCTlvLHoCb8RlPkiu5ca23e0Ki0iLnJC.jpeg" alt="" class="coment_form">
				<span class="text_coment">
					<p class="coment_name">Имя пользователя <span class = "com_date">07.27.2023/10.51.19</span></p>
					<p class="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis odio, voluptatum perspiciatis, neque tempore magnam possimus nemo pariatur ex qui sed, aliquam, maiores expedita atque deserunt animi? Repellat eius, pariatur.</p>
				</span>
			</span>
			<span class="coment">
				<img src="http://switter/public/storage/images/izubIecUoCTlvLHoCb8RlPkiu5ca23e0Ki0iLnJC.jpeg" alt="" class="coment_form">
				<span class="text_coment">
					<p class="coment_name">Имя пользователя <span class = "com_date">07.27.2023/10.51.19</span></p>
					<p class="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis odio, voluptatum perspiciatis, neque tempore magnam possimus nemo pariatur ex qui sed, aliquam, maiores expedita atque deserunt animi? Repellat eius, pariatur.</p>
				</span>
			</span>
			<span class="coment">
				<img src="http://switter/public/storage/images/izubIecUoCTlvLHoCb8RlPkiu5ca23e0Ki0iLnJC.jpeg" alt="" class="coment_form">
				<span class="text_coment">
					<p class="coment_name">Имя пользователя <span class = "com_date">07.27.2023/10.51.19</span></p>
					<p class="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis odio, voluptatum perspiciatis, neque tempore magnam possimus nemo pariatur ex qui sed, aliquam, maiores expedita atque deserunt animi? Repellat eius, pariatur.</p>
				</span>
			</span>
			<span class="coment">
				<img src="http://switter/public/storage/images/izubIecUoCTlvLHoCb8RlPkiu5ca23e0Ki0iLnJC.jpeg" alt="" class="coment_form">
				<span class="text_coment">
					<p class="coment_name">Имя пользователя <span class = "com_date">07.27.2023/10.51.19</span></p>
					<p class="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis odio, voluptatum perspiciatis, neque tempore magnam possimus nemo pariatur ex qui sed, aliquam, maiores expedita atque deserunt animi? Repellat eius, pariatur.</p>
				</span>
			</span>
			<span class="coment">
				<img src="http://switter/public/storage/images/izubIecUoCTlvLHoCb8RlPkiu5ca23e0Ki0iLnJC.jpeg" alt="" class="coment_form">
				<span class="text_coment">
					<p class="coment_name">Имя пользователя <span class = "com_date">07.27.2023/10.51.19</span></p>
					<p class="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis odio, voluptatum perspiciatis, neque tempore magnam possimus nemo pariatur ex qui sed, aliquam, maiores expedita atque deserunt animi? Repellat eius, pariatur.</p>
				</span>
			</span>

		</span>
		<span>
			
		</span>
		</span>
	</span>
</span>
</span>

	<script src = "{{ asset('public/js/AjaxComment.js') }}"></script>
	<script src = "{{ asset('public/js/Ajax.js') }}"></script>


	
</html>