<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CasHomeTest</title>
</head>
<body>
<header>
    <ul>
        <form id="logout-form" action="{{ route('casLogout') }}" method="GET" style="display: inline;">

            <button type="submit">Salir</button>
        </form>

    </ul>
</header>
<h1>Bienvenido {{Auth::user()->name}}</h1>
</body>
</html>