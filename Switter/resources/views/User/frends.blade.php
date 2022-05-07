		@extends('inc.app')

        @section('title')
	 		Подписки {{ $user->name }}
		@endsection

		@section('content')
		@include('inc.header_user')
		@include('inc.menu')
		<div class="content">
			<h1 class = "h">Подписки {{ $user->name }}
			</h1>
		    @if(!$user->getSuber()->count())
		    	нет подписок
		    @else
		  		<span id = 'scroll_y'>
		   			@foreach($users as $user)
		    			<span class="block_sub">
		      				<img src="{{ asset('/public/storage/'.$user->avatar) }}">
		      				<span class="name_user"><a href="{{ route ('social.users.show', $user->id) }}"><span>{{ $user->name }}</span></a></span>
		  					@if($user->sub == "red")
		  						<span class='but {{ $user->id}}'><button onclick = "unsubscrube({{$user->id}})" class='sub' id="{{$user->id}}">Подписан(а)</button></span>
		  					@else
		      					<span class="but">
		      						<button class="but_sub" 
		      								id = "{{$user->id }}" >
		      								Подписаться
		      						</button>
		     					</span>
		     				@endif
		    			</span>
		    		@endforeach
		    		<h1 class = "h">Рекомендации</h1>
		    @endif
		 		</span>
		</span>
  		</div>
		
		@include('inc.footer')
		@endsection
