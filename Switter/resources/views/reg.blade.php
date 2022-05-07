		@extends('inc.app')

        @section('title')
	     Регистрация
		@endsection

		@section('content')
		<div class="header">
				<div id="log">Switter</div>	
		</div>
		<div class="menu">
			<a href="/reg" id = "reg" class ="active"
><span>Регистрция</span></a>
			<a href="/" id = "aut" class = 
><span>Войти</span></a>
		</div>
		<div class="content">
		
          @include('inc.reg') 
		</div>

		<div class="footer">
			<p>Switer-2020</p><p>Made:Леха</p>
		</div>	
@endsection