<?php
require_once('db.php');

// Verifica si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

    // Datos del nuevo usuario
    $newUserName = $_POST['newUserName'];
    $newPassword = $_POST['password'];
    $user_id = $_SESSION['user_id']; // Obtiene el ID del usuario actual

    // Consultar el usuario // Verificar disponibilidad de usuario ingresado
    $sql = "SELECT id, username FROM users WHERE username = '$newUserName'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Si el usuario ya existe verifica si el usuario encontrado no es el actual
        if($row['id'] != $user_id){
            $_SESSION['message'] = 'Usuario no disponible. Por favor inténtalo de nuevo.';
            $_SESSION['message_type'] = 'error'; // Tipo de alerta (error, success, info, etc.)
            $_SESSION['message_title'] = 'Error de actualización.'; // Título de la alerta
        
            header('Location: dashboard.php'); // Redirige
            exit();
        }        
    }
        // Procesa el formulario si se envió

        $hashed_newPassword = hash('sha256', $newPassword); // Hashear la contraseña

        // Actualiza los datos en la base de datos
        $query = "UPDATE users SET username = '$newUserName', password = '$hashed_newPassword' WHERE id = '$user_id'";

        if (mysqli_query($conn, $query)) {
            $_SESSION['message'] = '¡Datos actualizados correctamente! debes iniciar sesión nuevamente.';
            $_SESSION['message_type'] = 'success';
            $_SESSION['message_title'] = 'Actualización exitosa.';
            header('Location:index.php');
            exit();
        } else {
            $_SESSION['message'] = 'Error al actualizar los datos:' . mysqli_error($conn);
            $_SESSION['message_type'] = 'error';
            $_SESSION['message_title'] = 'Error en actualización.';
            header('Location:index.php');
            exit();
        }

    // Cierra la conexión
    $conn->close();
?>