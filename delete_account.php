
<?php
session_start();
include("db.php");

// Verifica si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Elimina la cuenta del usuario
$query = "DELETE FROM users WHERE id = '$user_id'";
if (mysqli_query($conn, $query)) {
    session_destroy();
    header("Location: index.php?message=account_deleted");
    exit();
} else {
    header("Location: dashboard.php?error=delete_failed");
    exit();
}
?>
