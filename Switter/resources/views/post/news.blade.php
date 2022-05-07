@extends('inc.app')

@section('title')
	     Новости
@endsection

		@section('content')
		@include('inc.header_user')
		@include('inc.menu')
		<div class="content">
				@foreach($posts as $post)
				<span class='post' id = '{{$post->id}}'>
  					<span class='post_header'>
  						<img src='http://switter/public/storage/{{ $post->user_avatar}}' alt='#'><span class = 'user_name'><p><a href = 'http://switter/user/{{ $post->user_id}}'>{{$post->user_name}}</a></p></span>
  					</span>
  					<span class='post_content'>
  						<img src='http://switter/public/storage/{{$post->photo_post}}' alt=''>
  						<p>{{$post->content_raw}}</p>
  					</span>
  					<span class='post_footer'>
  						<p>{{$post->publushed_at}}</p><p><a href='#popup_comment' 
                onclick="Post({{$post->id}})" class = "com_but" id = "{{$post->id}}">Коменнтари</a></p><p>3000 c</p>
  					</span>
            
  				</span>
  				@endforeach
			</span>		
		</div>
	
@include('inc.footer')
@endsection