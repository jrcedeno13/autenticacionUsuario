<?php
  include('db.php');

  if (isset($_POST['go_login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashed_password = hash('sha256', $password);
    
    // Consultar el usuario
    $sql = "SELECT id, username, password FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) { // Hay al menos un resultado
      $row = mysqli_fetch_assoc($result); 
            
      // Comparar contraseña ingresada con la almacenada
      if ($hashed_password === $row['password']) {
        // Con contraseña correcta
        $_SESSION["user_id"] = $row["id"];
        $_SESSION["username"] = $row["username"];

        // Redirigir al dashboard
        header("Location: dashboard.php");
        exit();
      } else { 
               // Manejar mensajes de error
               $_SESSION['message'] = "Usuario o contraseña incorrectos. Intenta nuevamente.";
               $_SESSION['message_type'] = "error";
               $_SESSION['message_title'] = "Error de inicio de sesión";
               header("Location: index.php");
               exit();;
             } 
    } else { 
             // Manejar mensajes de error
             $_SESSION['message'] = "Acceso denegado, Usuario no registrado.";
             $_SESSION['message_type'] = "error";
             $_SESSION['message_title'] = "Error de inicio de sesión";
             header("Location: index.php");
             exit();;
           }
  }
$conn->close();
?>
