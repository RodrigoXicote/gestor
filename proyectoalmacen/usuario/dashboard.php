<?php
// Inicia la sesión
session_start();

// Verifica si el usuario ha iniciado sesión y es un usuario normal
if (!isset($_SESSION['id_usuario']) || $_SESSION['rol'] !== 'usuario') {
    header('Location: /proyectoalmacen/almacen/usuario/dashboard.php');
exit;

}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Panel de Usuario</a>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../logout.php">Cerrar Sesión</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Contenido -->
    <div class="container mt-5">
        <h1 class="text-center">Bienvenido, Usuario</h1>
        <p class="text-center">Este es el panel de usuario.</p>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
