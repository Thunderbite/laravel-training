<!DOCTYPE html>
<html lang="en">
	
	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>{{ config('app.name', 'Thunderbite') }}</title>

		<link href="//fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
		<link href="/css/admin.css" rel="stylesheet">

		<script>
			window.Thunderbite = {!! json_encode([
				'csrfToken' => csrf_token(),
			]) !!};
		</script>

	</head>

	<body>

		<div id="app">
			
			<nav class="navbar navbar-default navbar-static-top">
				<div class="container">
					<div class="navbar-header">
						<a class="navbar-brand" href="{{ url('/admin') }}">
							{{ config('app.name', 'Thunderbite') }}
						</a>
					</div>
				</div>
			</nav>

			@yield('content')

		</div>

		<script src="/js/admin.js"></script>

	</body>
</html>