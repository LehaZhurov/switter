
		@extends('inc.app')

        @section('title')
	     Вход
		@endsection

		@section('content')
		<div class="header">
				<div id="log">Switter</div>	
		</div>
		<div class="menu">
			<a href="/reg" id = "reg" class = @if(Request::is('/reg')) "active" @endif
><span>Регистрция</span></a>
			<a href="/" id = "aut" class = @if(Request::is('/')) "active" @endif
><span>Войти</span></a>
		</div>
		<div class="content">
			@if(Request::is('/')) @include('inc.avto') @endif
			@if(Request::is('/reg')) @include('inc.reg') @endif
		</div>

		<div class="footer">
			<p>Switer-2020</p><p>Made:Леха</p>
		</div>	
@endsection
