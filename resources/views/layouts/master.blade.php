<!DOCTYPE html>
<html lang="lt">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Aforizmų galerija | @yield('title')</title>
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

			<link rel="stylesheet" href="{{ URL::to('src/css/bootstrap.min.css') }}" type="text/css" />
		    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
			<link href='https://fonts.googleapis.com/css?family=Kaushan+Script&subset=latin,latin-ext' rel='stylesheet' type='text/css'>    
			<link href='https://fonts.googleapis.com/css?family=Aladin&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
			<link href='https://fonts.googleapis.com/css?family=Lobster&subset=latin-ext,latin' rel='stylesheet' type='text/css'>
			<link rel="stylesheet" href="{{ URL::to('src/css/blockquote.css') }}" type="text/css" />
	</head>
	<body id="app-layout">
		@include('includes.header')
		@yield('content')
		@include('includes.footer')
			<script src="https://code.jquery.com/jquery-2.2.4.min.js"
			  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
			  crossorigin="anonymous"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	</body>
</html>