<?php include("db.php"); 

// Verifica si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Datos</title>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
</head>


<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php">Mi panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">Menú</a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                            <li><a class="dropdown-item" href="dashboard.php">Inicio</a></li>
                            <li><a class="dropdown-item" href="#" onclick="confirmarCierre(event)">Cerrar sesión</a></li>
                            
                        </ul>
                    </li>
                </lu>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h3 class="text-center">Actualizar Datos.</h3>
                <?php if (!empty($mensaje)): ?>
                    <div class="alert alert-info">
                        <?php echo htmlspecialchars($mensaje); ?>
                    </div>
                <?php endif; ?>
                <form action="update_user.php" method="POST">
                    <div class="mb-3">
                        <label for="newUserName" class="form-label">Nuevo Nombre de usuario:</label>
                        <input type="text" class="form-control" id="newUserName" name="newUserName" value="<?php echo htmlspecialchars($_SESSION['username']); ?>" placeholder="nombre de usuario" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Nueva Contraseña:</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="nueva contraseña" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirmar contraseña:</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="confirmar contraseña" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100" name="update_user">Actualizar</button>
                </form>
            </div>
        </div>
    </div>

    <script> // Verificar si las contraseñas coinciden
        
        const form = document.querySelector('form');
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirm_password');

        form.addEventListener('submit', (e) => {
            if (password.value !== confirmPassword.value) {
                e.preventDefault(); // Evita el envío del formulario
                alert('Las contraseñas no coinciden. Por favor inténtalo de nuevo.');
            }
        });
    </script>

    <?php

        if (isset($_SESSION['message'])) {
            echo "
            <script>
                Swal.fire({
                    icon: '{$_SESSION['message_type']}',
                    title: '{$_SESSION['message_title']}',
                    text: '{$_SESSION['message']}',
                    confirmButtonText: 'Aceptar'
                });
            </script>";
            // Limpiar el mensaje después de mostrarlo
            unset($_SESSION['message']);
            unset($_SESSION['message_type']);
            unset($_SESSION['message_title']);
        }
    ?>

    <!-- Formulario de logout oculto -->
    <form id="logoutForm" action="logout.php" method="POST" style="display: none;"></form>

    <!-- Script para confirmar cierre -->
    <script>
        function confirmarCierre() {
            Swal.fire({
                title: '¿Está seguro de que desea cerrar sesión?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, salir',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Envía el formulario de logout
                    document.getElementById("logoutForm").submit();
                }
            });
        }
    </script>


<?php include("includes/footer.php"); ?>

<!-- Bootstrap JS (opcional para funcionalidad avanzada) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

