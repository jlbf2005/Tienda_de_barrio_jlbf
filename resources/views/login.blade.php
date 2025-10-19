<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/logoTienda.png') }}">
    <title>Login</title>
</head>

<header>
    <nav class="navbar bg-dark">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div>
                <img src="{{ asset('images/logoTienda.png') }}" alt="Logo Tienda" class="navbar-brand" style="height: 50px;">
            </div>
            <div>
                <a href="{{ route('inicio') }}" class="btn btn-primary">Inicio</a>
            </div>
        </div>
    </nav>
</header>

<body>
    <div class="container-fluid d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-lg p-4" style="max-width: 450px; width: 100%;">
            <div class="card-body">
                <h2 class="text-center mb-4">Iniciar Sesión</h2>


                <form id="loginForm" data-user-dashboard-url="{{ route('usuario') }}">
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" required>
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Recordarme</label>
                    </div>

                    <div id="errorMessage" class="alert alert-danger d-none"></div>

                    <button type="submit" class="btn btn-primary w-100">Ingresar</button>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>


    <script src="{{ asset('js/login.js') }}"></script>
</body>

</html>