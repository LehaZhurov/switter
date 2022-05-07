@extends('inc.app')

@section('title')
 Редактирование поста
@endsection

@section('content')
@include('inc.header_user')
@include('inc.menu')
<div class="content">
	<div id="redact">
		<h1 class="h">Редактирование поста</h1>
		<form class="form_redact" method = "POST" action = "{{ route('social.posts.update',$post->id) }}" enctype="multipart/form-data">
			@csrf
			@method('PATCH')
			<p>ID:<input name = "id" type = "text" value = "{{ $post->id}}" disabled="" class = "input_redact"></p>
			<p>Имя пользователя:<input name = "" type = "text" value = "{{$user->name}}" disabled="" class = "input_redact"></p>
			<p>Текст<br><textarea name = "content_raw">{{ $post->content_raw}}</textarea></p>
			<p>Фото поста <input name = "images_post" type = "file" value = ""></p>
			<p>Опубликованно:<input name = "created_at" type = "text" value = "{{ $post->created_at}}" disabled="" class = "input_redact"></p>
			<p>Измененно:<input name = "updated_at" type = "text" value = "{{ $post->updated_at}}" disabled="" class = "input_redact"></p>
			<button class = "but_sub">Сохранить</button> 
		</form>
		<form action="{{ route('social.posts.destroy' , $post->id) }}" method = "POST">
			@csrf	
	 		@method('DELETE')
			<button class="sub" type="submit">Удалить</button>
		</form>
	</div>
</div>
@include('inc.footer')
@endsection