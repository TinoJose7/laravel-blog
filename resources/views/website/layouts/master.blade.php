<!DOCTYPE html>
<html lang=en>
<head>
	<meta charset=UTF-8>
	<meta http-equiv=X-UA-Compatible content="IE=edge">
	<meta name=viewport content="width=device-width, initial-scale=1">
	<meta name=Description content="">
	<meta name=keywords content="">

	@include('website.partials.head')
</head>

<body data-spy=scroll data-target=#main-nav-collapse data-offset=100>
	<div class=page-loader>
		<div class=loader>Loading...</div>
	</div>

	@include('website.partials.navbar')

	@yield('content')

	@include('website.partials.footer')

	@include('website.partials.scripts')

</body>

</html>
