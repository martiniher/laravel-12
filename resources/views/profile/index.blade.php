<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil</title>
</head>
<body>
    <h1>Perfil de Usuario</h1>

    @if (Auth::user())
        <p><strong>Nombre:</strong> {{ Auth::user()->name }}</p>
        <p><strong>Correo Electrónico:</strong> {{ Auth::user()->email }}</p>
    @else
        <p>Error: No se ha podido cargar la información del usuario.</p>
    @endif

    <hr>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">
            Cerrar Sesión
        </button>
    </form>
</body>
</html>