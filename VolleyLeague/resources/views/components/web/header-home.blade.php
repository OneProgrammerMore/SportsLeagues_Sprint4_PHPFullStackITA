<nav id="navBar">
	<div id="webID" class="container-fluid">
		<i id="webLogo">
			<img id="webLogoImg" src="{{ asset('img/cupLogo.png')}}" alt="Web Logo - The image of a Tournament Cup">
		</i>
		<a id="webName" href={{ route('leagues.index') }}>Cup</a>
	</div>

	<div id="navSections" class="flex flex-row">
		<div class="itemNav">
			<a class="btn btn-sm btn-success" href={{ route('leagues.index') }}>Home - Leagues</a>
		</div>

	
	
	@if (Route::has('login'))
		<div class="itemNav">
			@auth
				<a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
			@else
				<a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

				@if (Route::has('register'))
					<a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
				@endif
			@endauth
		</div>
	@endif
	
	
	</div>
</nav>
