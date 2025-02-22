<?php
session_start();
include __DIR__ . '/config/db.php';  // Incluye la conexión a la base de datos

// Verifica si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $rol = $_POST['rol'];  // El rol lo seleccionas en el formulario

    // Cifra la contraseña
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Inserta el nuevo usuario
    $query = "INSERT INTO usuarios (email, password, rol) VALUES ('$email', '$hashed_password', '$rol')";
    if (mysqli_query($conn, $query)) {
        echo "Usuario registrado exitosamente.";
        // Redirige al login después de la inserción exitosa
        header("Location: almacen/login.php");  // Redirige al login en la raíz del proyecto
        exit();
        
    } else {
        echo "Error al registrar el usuario: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Registro de Usuario</h2>
        <form method="POST" action="register.php">
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <div class="mb-3">
                <label for="rol" class="form-label">Rol</label>
                <select class="form-control" name="rol" required>
                    <option value="Administrador">Administrador</option>
                    <option value="Usuario">Usuario</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
</body>
</html>

