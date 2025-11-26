<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
</head>
<body>
    <h1>Iniciar Sesión</h1>

    @if (session('error'))
        <div style="background-color: #fdd; color: #a00; border: 1px solid #a00; padding: 10px; margin-bottom: 20px;">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login.authenticate') }}">
        @csrf

        <div>
            <label for="email">Correo Electrónico</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>

            @error('email')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="password">Contraseña</label>
            <input id="password" type="password" name="password" required>

            @error('password')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="age">Años</label>
            <input id="age" type="number" name="age" value="{{ old('age') }}" min="1" required>

            @error('age')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>
        
        <div>
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">Recuérdame</label>
        </div>

        <div>
            <button type="submit">
                Entrar
            </button>
        </div>
    </form>
</body>
</html>