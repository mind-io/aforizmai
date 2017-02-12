<!DOCTYPE html>
<html lang="lt">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Aforizmų galerija | @yield('title')</title>

			<link rel="stylesheet" href="{{ URL::to('src/css/bootstrap.min.css') }}" type="text/css" />
		    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
			<link href='https://fonts.googleapis.com/css?family=Kaushan+Script&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
			
			@yield('styles')
			<link rel="stylesheet" href="{{ URL::to('src/css/blockquote.css') }}" type="text/css" />
	</head>
	<body id="app-layout">
		@include('includes.header')
		@yield('content')
		@include('includes.footer')
		<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
		{{-- <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script> --}}
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		{{-- Dropdown parent link clickable --}}
{{-- 		<script type="text/javascript">
			$('.dropdown-toggle').click(function() {
		    	var location = $(this).attr('href');
		    	window.location.href = location;
		    	return false;
			});
		</script> --}}
		@yield('scripts')
	</body>
</html>