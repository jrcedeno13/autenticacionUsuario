<?php
session_start();

// Destruye la sesión
session_unset();
session_destroy();

// Redirige al login
header("Location: index.php");
exit();
$conn->close();
?>