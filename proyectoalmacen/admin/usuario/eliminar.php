<?php
// Incluir la conexión a la base de datos
include '../../almacen/config/db.php';

// Verificar si se ha enviado el parámetro 'id'
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Consulta para eliminar el usuario
    $query = "DELETE FROM usuarios WHERE id_usuario = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        // Redireccionar a la lista de usuarios si se eliminó correctamente
        header("Location: listar.php?mensaje=eliminado");
    } else {
        echo "Error al eliminar el usuario.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "ID de usuario no válido.";
}
?>
