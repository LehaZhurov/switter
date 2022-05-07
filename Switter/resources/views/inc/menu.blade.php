<div class="menu">
			<a href="/news"    
<?if($_SERVER['REQUEST_URI'] == "/news"){ echo "class = 'active'";} ?>
			><span>Новости</span></a>
			<a href="/mess"    
<?if($_SERVER['REQUEST_URI'] == "/mess"){ echo "class = 'active'";} ?>
			><span>Сообщения</span></a>
			<a href="/users"    
<?if($_SERVER['REQUEST_URI'] == "/users"){ echo "class = 'active'";} ?>
			><span>Рекомендации</span></a>
			<a href="{{ route ('social.users.show', Auth::id()) }}"    
<?if($_SERVER['REQUEST_URI'] == "/user/ {{ Auth::id() }}"){ echo "class = 'active'";} ?>
			><span class = "User" id = "{{ Auth::id() }}">Профиль</span></a>
</div>
