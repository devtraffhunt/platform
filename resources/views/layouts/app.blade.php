<!DOCTYPE html>
<html lang="en">

<head>
	<script src="https://telegram.org/js/telegram-web-app.js?57"></script>
	@vite(['resources/css/app.css', 'resources/js/app.js'])
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title>{{$setting->name}}</title>
	<link rel="apple-touch-icon" sizes="64x64" href="/img/fav.png" />
	<link rel="icon" sizes="64x64" href="/img/fav.png" />
	<link href="https://fonts.googleapis.com/css?family=Inter:400,500,700&display=swap" rel="stylesheet" />
	<link rel="stylesheet" href="/css/main.css?id=1" />
	<link rel="stylesheet" href="/styles/globals.css">

	<script src="https://cdn.socket.io/4.8.1/socket.io.min.js" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-scrollbar@latest/simple-scrollbar.css" />
	<script src="https://cdn.jsdelivr.net/npm/simple-scrollbar@latest/simple-scrollbar.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
	<link rel="stylesheet" href="/css/ripple.css" />
	<link rel="stylesheet" href="/css/index.css?v=12" />

	<!-- <script async src="https://telegram.org/js/telegram-widget.js?21" data-telegram-login="betusxbot" data-size="large" data-auth-url="https://betusx.pro/tg/auth/callback" data-request-access="write"></script>
    <script src="https://telegram.org/js/widget-frame.js?60" data-telegram-login="betusxbot" data-size="large" data-auth-url="https://betusx.pro/tg/auth/callback" data-request-access="write"></script> -->
</head>


<body class="theme--dark">
	<div class="preloader d-flex align-center justify-center">
		<div class="preloader__lift d-flex align-center justify-center">
			<div class="preloader__lift-container d-flex align-center justify-space-between">
				<div class="preloader__loader">
					<img width="250px" src="/img/logo2.svg">
					<div class="spinner"></div>
				</div>
			</div>
		</div>
	</div>

		@guest
	@include('layouts.login')
	@endguest

	<div id="app">
		<div class="main">
			@include('layouts.header')
			<div class="gx-s">
				<main>
					@yield('content')
				</main>
				@include('layouts.footer')
				@include('layouts.mobile_menu')
			</div>
		</div>
	</div>




@auth
<script>
    window.USER_ID = {{ Auth::id() }};
</script>
@endauth



	@if(session('error'))
	<script>
		notification('error', "{{ session('error') }}")
	</script>
	@endif

</body>

</html>