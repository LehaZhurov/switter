@extends('inc.app')

        @section('title')
	     Редактирование 
		@endsection

		@section('content')
		 @include('inc.header_user')
		 @include('inc.menu')
<div class = "dop_block"> 
	<form id="form" method="post" 
	action="{{ route ('social.user.name', Auth::id()) }}"
	enctype="multipart/form-data"
	>
				@csrf
				<h1>Редактирование</h1>
				<label for="name">Никнейм</label>
				<input 
					type="text" id="name" 
					name = 'name'class="input_form" 
					placeholder="Никнейм" value=""
				>
				<label for="name">Фото</label>
				<input 
					type="file" id="file" 
					name = 'photo'class="input_form" 
					placeholder="Фото"
				>
			    <button class = "but_sub">Сохранить</button>            
</form>
<form 	id="form" method="post" 
		action="{{ route ('social.users.update', Auth::id()) }}" 
>
				@csrf
				@method('PATCH')
				<h1>Изменить пароль</h1>
				<label for="password">Старый пароль</label>
				<input 
					type="password" id="password" 
					name ='old_password' class="input_form" 
					placeholder="Старый пароль" value="">
				<label for="password">Новый пароль</label>
				<input 
					type="password" id="password_confirmation" 
					name ='new_password' class="input_form" 
					placeholder="Новый пароль" value="">
			    <button class = "but_sub">Сохранить</button>            
</form>

</div>
		 @include('inc.footer')
		@endsection
<style>   
	.dop_block{
		width:106%;
		background-color:white;
		display:flex;
		justify-content:center;
		flex-direction: column;
		align-items: center;
	}
</style>