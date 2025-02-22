<?php
session_start();
// Incluir la configuración de la base de datos
include __DIR__ . '/config/db.php'; // Asegúrate de que la ruta es correcta

// Variable para mostrar errores
$error = "";

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Depurar los datos enviados por POST
    var_dump($_POST); // Para ver qué datos están llegando

    // Validar si se enviaron los campos
    if (empty($_POST['email']) || empty($_POST['password'])) {
        $error = "Por favor, ingresa tu correo electrónico y contraseña.";
    } else {
        // Recoger los datos del formulario
        $email = mysqli_real_escape_string($conn, $_POST['email']);

        // Asegurarse de que 'password' existe en $_POST antes de continuar
        if (isset($_POST['password'])) {
            $password = $_POST['password']; // Capturar la contraseña
        } else {
            $error = "La contraseña no fue enviada correctamente.";
        }

        // Si no hay errores, proceder con la consulta
        if (empty($error)) {
            // Consulta para obtener el usuario usando una consulta preparada
            $query = "SELECT * FROM usuarios WHERE email = ?";
            $stmt = mysqli_prepare($conn, $query);

            // Comprobar si la preparación de la consulta fue exitosa
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "s", $email); // Vinculamos el email con el parámetro de la consulta

                // Ejecutar la consulta
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                // Comprobar si el usuario existe
                if (mysqli_num_rows($result) > 0) {
                    $user = mysqli_fetch_assoc($result);

                    // Verificar si la contraseña es correcta
                    if (password_verify($password, $user['password'])) {
                        // Iniciar sesión
                        $_SESSION['usuario_id'] = $user['id'];
                        $_SESSION['email'] = $user['email'];
                        $_SESSION['rol'] = $user['rol'];

                        // Redirigir según el rol
                        if ($user['rol'] == 'Administrador') {
                            header("Location: proyectoalmacen/admin/usuario/almacen/index.php");
                            exit(); // Es importante usar exit después de header()
                        } else {
                            header("Location: http://localhost/proyectoalmacen/almacen/usuario/dashboard.php");
                            exit(); // Es importante usar exit después de header()
                        }
                    } else {
                        $error = "Contraseña incorrecta.";
                    }
                } else {
                    $error = "El usuario no existe.";
                }

                // Cerrar la declaración
                mysqli_stmt_close($stmt);
            } else {
                $error = "Error en la consulta de la base de datos.";
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
    <title>Inicio de Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-header text-center bg-primary text-white">
                        <h3>Iniciar Sesión</h3>
                    </div>
                    <div class="card-body">
                        <!-- Mostrar mensaje de error si existe -->
                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger text-center">
                                <?php echo $error; ?>
                            </div>
                        <?php endif; ?>
                        <form method="POST" action="login.php">
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <small>¿No tienes una cuenta? <a href="register.php">Regístrate aquí</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

