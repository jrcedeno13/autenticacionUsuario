<?php
session_start();

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
        <title>Dashboard</title>

        <!-- SweetAlert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
        
        
        <!-- JavaScript -->
        <script>
            function confirmarCierre(event) {
                event.preventDefault(); // Evita el envío del formulario por defecto
                const confirmacion = confirm("¿Está seguro de que desea cerrar sesión?");
                if (confirmacion) {
                    // Si el usuario confirma, envía el formulario
                    document.getElementById("logoutForm").submit();
                }
            }
        </script>

    </head>
    <body>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Mi panel</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Menú
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                                <li><a class="dropdown-item" href="actualizacion.php">Actualizar datos</a></li>
                                <li><a class="dropdown-item text-danger" href="#" onclick="confirmarEliminarCuenta()">Eliminar cuenta</a></li>
                                <li><a class="dropdown-item" href="#" onclick="confirmarCierre(event)">Cerrar sesión</a><li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Contenido -->
        <form id="logoutForm" action="logout.php" method="POST">
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-8 text-center">
                        <div class="card shadow-lg">
                            <div class="card-body">
                                <h1 class="display-5">Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
                                <p class="lead">¡Has iniciado sesión exitosamente!</p>
                                <button type="button" class="btn btn-danger mt-3" onclick="confirmarCierre(event)">Cerrar sesión</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

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
<form id="deleteAccountForm" action="delete_account.php" method="POST" style="display: none;"></form>

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

// Confirmar eliminación de cuenta
        function confirmarEliminarCuenta() {
            Swal.fire({
                title: '¿Está seguro de que desea eliminar su cuenta?',
                text: 'Esta acción no se puede deshacer.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("deleteAccountForm").submit();
                }
            });
        }
    </script>

<!-- Bootstrap JS (opcional para funcionalidad avanzada) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>