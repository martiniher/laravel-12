<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>¡Bienvenido a tu Dashboard!</h1>

    @if ($user)
        <p>Estás conectado como: <strong>{{ $user->name ?? 'Usuario' }}</strong></p>
        <p>Tu correo electrónico es: <strong>{{ $user->email }}</strong></p>
        <a href="{{ route('profile.index') }}">ver  Profile </a>
    @else
        <p>No se pudo cargar la información del usuario.</p>
    @endif

    <hr>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">
            Cerrar Sesión (Logout)
        </button>
    </form>
</body>
</html>