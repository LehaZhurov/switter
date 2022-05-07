@extends('inc.app')

@section('title')
	     {{$users->name}}
@endsection

		@section('content')
		@include('inc.header_user')
		@include('inc.menu')
		<div class="content">
			<span class="header-user">
				<span id="photo_user">
					<img src="{{ asset('/public/storage/'.$users->avatar) }}" alt="" id = "user_photo">
				</span>
				<span id="info_user">
					<p id="name_user">{{$users->name}}</p>
					<input id = "userid" value = "{{$users->id }}">
					<span id="control">
						<a href="{{ route ('social.users.frends.user', $users->id) }}">Подписок {{$users->getSuber()->count()}}</a>
						<a href="{{ route ('social.users.subers.user', $users->id) }}">Подписчиков {{$users->getBlogger()->count()}}</a>
						@if($users->id == Auth::id())
						<a href="{{ route ('social.users.edit', Auth::id()) }}">Редактировать</a>
						<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                          {{ __('Выйти') }}
                        </a>
						<form id="logout-form" 
								action="{{ route('logout') }}" 
								method="POST" 
								style="display: none;">
                                @csrf
                        </form>
                    @else
                    	@if($users->submy == "red")
		      					<span class='but {{$users->id }}'><span class='sub' id = "{{$users->id }}">Подписан(а)</span></span>
		  				@else

		      				<span class="but {{$users->id }}">
		      					<button class="but_sub" 
		      							id = "{{$users->id }}" >
		      						Подписаться
		      					</button></span>
		     			@endif
					@endif
					</span>
				</span>
		</span>
			<span class="posts">
				@if($users->id == Auth::id())
				<p>Ваши записи <a href="#popup" id = "new_post">Добавить запись</a></p>
				@endif
				
			</span>
			
		</div>
	
		@include('inc.footer')
		@endsection
