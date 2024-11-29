<?php
require_once('db.php');

if (isset($_POST['save_user'])) {

    // Datos del nuevo usuario
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hashear la contraseña
    $hashed_password = hash('sha256', $password);

    $query = "INSERT INTO users(username, password) VALUES ('$username', '$hashed_password')";
    $result = mysqli_query($conn, $query);
    if(!$result) {
      die("Query Failed.");
    }
  
    $_SESSION['message'] = 'Registro exitoso';
    $_SESSION['message_type'] = 'success';
    $_SESSION['message_title'] = 'Usuario creado.';
    header('Location: index.php');
}

$conn->close();
?>
