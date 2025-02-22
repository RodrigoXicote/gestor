<?php
// Incluir la conexión a la base de datos
include __DIR__ . '/../../almacen/config/db.php';

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Definir variables
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario y sanitizarlos
    $email = trim(mysqli_real_escape_string($conn, $_POST['email']));
    $password = trim($_POST['password']);
    $rol = trim(mysqli_real_escape_string($conn, $_POST['rol']));

    // Validar que el rol sea válido
    $roles_permitidos = ['Administrador', 'Usuario'];
    if (!in_array($rol, $roles_permitidos)) {
        $error = 'Rol inválido.';
    } elseif (strlen($password) < 6) {
        $error = 'La contraseña debe tener al menos 6 caracteres.';
    } else {
        // Verificar si el correo ya está registrado
    // Verificar si el correo ya está registrado
$query_check_email = "SELECT email FROM usuarios WHERE email = '$email'";
$result_check_email = mysqli_query($conn, $query_check_email);

// Comprobar si la consulta fue exitosa
if (!$result_check_email) {
    die("Error en la consulta: " . mysqli_error($conn)); // Muestra el error de MySQL
}

if (mysqli_num_rows($result_check_email) > 0) {
    $error = 'El correo electrónico ya está registrado.';
} else {
    // Encriptar la contraseña
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insertar el nuevo usuario en la base de datos
    $query = "INSERT INTO usuarios (email, password, rol) VALUES ('$email', '$hashed_password', '$rol')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $success = 'Usuario registrado exitosamente. Redirigiendo...';
        header("refresh:3; url=login.php"); // Redirige al login después de 3 segundos
    } else {
        $error = 'Error al registrar el usuario: ' . mysqli_error($conn);
    }
}

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
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-header text-center bg-primary text-white">
                        <h3>Registrar Nuevo Usuario</h3>
                    </div>
                    <div class="card-body">
                        <!-- Mostrar errores -->
                        <?php if ($error): ?>
                            <div class="alert alert-danger text-center">
                                <?php echo $error; ?>
                            </div>
                        <?php endif; ?>

                        <!-- Mostrar éxito -->
                        <?php if ($success): ?>
                            <div class="alert alert-success text-center">
                                <?php echo $success; ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="crear.php">
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" name="password" id="password" class="form-control" required minlength="6">
                            </div>
                            <div class="mb-3">
                                <label for="rol" class="form-label">Rol</label>
                                <select name="rol" id="rol" class="form-control" required>
                                    <option value="Administrador">Administrador</option>
                                    <option value="Usuario">Usuario</option>
                                </select>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Registrar Usuario</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
