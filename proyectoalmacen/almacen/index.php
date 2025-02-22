<?php
// Iniciar sesión
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id_usuario'])) {
    header('Location: /proyectoalmacen/almacen/login.php');
    exit;
}

// Conexión a la base de datos
include __DIR__ . '/config/db.php';


// Obtener datos del usuario
$id_usuario = $_SESSION['id_usuario'];
$query = "SELECT email FROM usuarios WHERE id_usuario = '$id_usuario'";
$result = $conn->query($query);
$usuario = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Sistema de Almacén</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <style>
        .card:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transform: scale(1.02);
        }

        .btn-light:hover {
            background-color: #f8f9fa;
            color: #000;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Sistema de Almacén</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/proyectoalmacen/almacen/admin/usuarios/listar.php">Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/proyectoalmacen/almacen/admin/productos.php">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/proyectoalmacen/almacen/admin/movimientos.php">Movimientos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/proyectoalmacen/almacen/admin/ventas.php">Ventas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-danger text-white" href="/proyectoalmacen/almacen/logout.php">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Panel de Control</h2>
        <h5 class="text-center mb-4">Bienvenido, <?php echo $usuario['email']; ?></h5>
        <div class="row">
            <!-- Tarjeta de Usuarios -->
            <div class="col-md-4 mb-4">
                <div class="card text-center bg-primary text-white">
                    <div class="card-body">
                        <h4 class="card-title">Usuarios</h4>
                        <p class="card-text">Gestiona a tus usuarios del sistema.</p>
                        <a href="/proyectoalmacen/almacen/admin/usuarios/listar.php" class="btn btn-light">Ver más</a>
                    </div>
                </div>
            </div>
            <!-- Tarjeta de Productos -->
            <div class="col-md-4 mb-4">
                <div class="card text-center bg-success text-white">
                    <div class="card-body">
                        <h4 class="card-title">Productos</h4>
                        <p class="card-text">Control de inventario y stock.</p>
                        <a href="/proyectoalmacen/almacen/admin/productos.php" class="btn btn-light">Ver más</a>
                    </div>
                </div>
            </div>
            <!-- Tarjeta de Movimientos -->
            <div class="col-md-4 mb-4">
                <div class="card text-center bg-warning text-white">
                    <div class="card-body">
                        <h4 class="card-title">Movimientos</h4>
                        <p class="card-text">Registro de entradas y salidas.</p>
                        <a href="/proyectoalmacen/almacen/admin/movimientos.php" class="btn btn-light">Ver más</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Tarjeta de Ventas -->
            <div class="col-md-4 mb-4">
                <div class="card text-center bg-danger text-white">
                    <div class="card-body">
                        <h4 class="card-title">Ventas</h4>
                        <p class="card-text">Historial de ventas y facturación.</p>
                        <a href="/proyectoalmacen/almacen/admin/ventas.php" class="btn btn-light">Ver más</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie de Página -->
    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2025 Sistema de Almacén. Todos los derechos reservados.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
