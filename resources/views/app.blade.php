<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplicación Pública - Inicio</title>
    
    <!-- Carga solo el CSS principal de la aplicación -->
    @vite('resources/css/app.css')
</head>
<body>
    <div class="container">
        <h1>Bienvenido a la Página Principal</h1>
        <p>Este es el contenido público de la aplicación. Aquí se cargan los estilos definidos en <code>resources/css/app.css</code>, que son más limpios y orientados al usuario final.</p>
        
        <p>Si esta fuera la vista de administración, el fondo y los colores de los títulos serían diferentes.</p>
        
        <a href="/admin" style="color: #48bb78; text-decoration: underline;">Ir a la Vista de Administración (Simulación)</a>
    </div>
</body>
</html>