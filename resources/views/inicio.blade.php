<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="icon" type="image/png" href="{{ asset('images/logoTienda.png') }}">
    <title>Inicio</title>

</head>
<header>
    <nav class="navbar bg-dark">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div>
                <img src="{{ asset('images/logoTienda.png') }}" alt="Logo Tienda" class="navbar-brand" style="height: 50px;">
            </div>
            <div>
                <a href="{{route('login')}}" class="btn btn-primary">Login</a>
            </div>
        </div>
    </nav>
</header>

<body class=" container-fluid p-0 m-0">
    <div class="d-flex justify-content-center align-items-center vh-100" style="background-image: url('{{ asset('images/fotoTienda.png') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <div class="text-center p-5 bg-white bg-opacity-75 rounded">
            <h1 class="display-4 mb-4">Bienvenido a Tienda Donde George</h1>
            <p class="lead mb-4">Tu tienda de confianza abierta las 24/7.</p>
        </div>
    </div>
</body>

</html>