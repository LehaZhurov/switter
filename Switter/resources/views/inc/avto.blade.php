


<form id="form" action="{{ route('login') }}" method="post">
				<h1>Вход</h1>
					@csrf
				<label for="login">Логин</label>
				<input 
					type="text" id="login" 
					name = 'login' class="input_form" placeholder="Логин"
					value="{{ Request::old('login') ?: ''}}">	
				<label for="password">Пароль</label>
				<input 
					type="password" id="password" name ='password'  
					class="input_form" placeholder="Пароль">
				<label for="password">Запомнить меня</label>
				<input 
					type="checkbox" id="password" name ='password'  
					class="input_form" placeholder="Пароль" value="1">
				<button class = "but_sub">Войти</button>
</form>