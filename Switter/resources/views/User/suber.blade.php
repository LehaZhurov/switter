		@extends('inc.app')

        @section('title')
	 		Подписчики {{ $user->name }}
		@endsection

		@section('content')
		@include('inc.header_user')
		@include('inc.menu')
		<div class="content">
			<h1 class = "h">Подписчики {{ $user->name }}
			</h1>
		    @if(!$user->getBlogger()->count())
		    	нет подписчиков
		    @else
		  		<span id = 'scroll_y'>
		   			@foreach($users as $user)
		    			<span class="block_sub">
		      				<img src="{{ asset('/public/storage/'.$user->avatar) }}">
		      				<span class="name_user"><a href="{{ route ('social.users.show', $user->id) }}"><span>{{ $user->name }}</span></a></span>
		  					@if($user->sub == "red")
		      					<span class='but'><span class='but_sub sub {{ $user->id}}'>Подписан(а)</span></span>
		  					@else
		      					<span class="but">
		      						<button class="but_sub" 
		      								onclick='subscrube({{$user->id }})'
		      								id = "{{$user->id }}" >
		      								Подписаться
		      						</button>
		     					</span>
		     				@endif
		    			</span>
		    		@endforeach
		    @endif
		 		</span>
		</span>
  		</div>
		
		@include('inc.footer')
		@endsection