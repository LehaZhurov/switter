
<form id="form" method="post" action="{{ route('register') }}">
	@csrf
				<h1>Регистрация</h1>
				<label for="name">Никнейм</label>
				<input 
					type="text" id="name" 
					name = 'name'class="input_form" 
					placeholder="Никнейм" value="{{ Request::old('name') ?: ''}}">
				<label for="login">Логин</label>
				<input 
					type="text" id="login" 
					name = 'login'class="input_form" 
					placeholder="Логин" value="{{ Request::old('login') ?: ''}}">
				<label for="password">Пароль</label>
				<input 
					type="password" id="password" 
					name ='password' class="input_form" 
					placeholder="Пароль" value="{{ Request::old('password') ?: ''}}">
				<label for="password">Повторите пароль</label>
				<input 
					type="password" id="password_confirmation" 
					name ='password_confirmation' class="input_form" 
					placeholder="Повторите пароль" value="{{ Request::old('password') ?: ''}}">
			    <button class = "but_sub">Регистрация</button>            
</form>