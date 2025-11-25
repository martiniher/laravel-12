<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>

    <!-- Carga el CSS específico del panel de administración -->
    @vite('resources/css/admin.css')
</head>
<body>
    <div class="admin-panel">
        <h1>Panel de Control del Sistema</h1>
        <div class="alert-info">
            <p><strong>Aviso Importante:</strong> Estás en el área restringida. Los estilos visuales son distintos (fondo oscuro, fuente diferente) porque está cargando el archivo <code>resources/css/admin.css</code>.</p>
        </div>
        
        <p>Esta separación de archivos CSS y JS en la configuración de Vite es ideal para mantener el rendimiento, ya que los usuarios del frontend nunca necesitan cargar los estilos del administrador, y viceversa.</p>

        <a href="/" style="color: #63b3ed; text-decoration: underline;">Volver a la Vista Principal (Simulación)</a>
    </div>
</body>
</html>