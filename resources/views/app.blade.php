<!DOCTYPE>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>Server Dashboard</title>
	
	<!-- Fonts -->
	<link rel="dns-prefetch" href="https://fonts.googleapis.com">
	<link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet" type="text/css">
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="{{ mix('css/app.css', 'vendor/server-dashboard') }}">
</head>
<body>
<main id="root"></main>

<script>
  window.baseUri = "{{ lrtrim(config('server-dashboard.uri'),'/') }}";
</script>
<script src="{{ mix('js/app.js', 'vendor/server-dashboard') }}"></script>
</body>
</html>
