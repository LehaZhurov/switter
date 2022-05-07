		@extends('inc.app')

        @section('title')
	     Результаты по запросу: {{ $search }}
		@endsection

		@section('content')
		@include('inc.header_user')
		@include('inc.menu')
		<div class="content">
		<form class="form_search" method = "POST" action = "{{ route('social.users.serach.user') }}">
			@csrf
			<input type="text" name="search" 
					class = "input_form" placeholder="Найти пользователей" 
					value = "{{ $search }}">
				<button class = "but_sub">Найти</button>
			</form>
			<h1 class = "h">Результаты по запросу: {{ $search }}</h1>
		    <span id = 'scroll_y'>
		   	@foreach($users as $user)
		    <span class="block_sub">
		      <img src="{{ asset('/public/storage/'.$user->avatar) }}">
		      <span class="name_user"><a href="{{ route ('social.users.show', $user->id) }}"><span>{{ $user->name }}</span></a></span>
		  	@if($user->sub == "red")
		      	<span class='but {{ $user->id}}'><span class='sub' id = "{{ $user->id}}">Подписан(а)</span></span>
		  	@else
		      	<span class="but {{ $user->id}}">
		      		<button class="but_sub" id = "{{$user->id }}" >Подписаться</button>
		     	</span>
		     @endif
		    </span>
		    @endforeach
		    <h1 class = "h">Рекомендации</h1>
		</span>
  		</div>
	
		@include('inc.footer')
		@endsection
