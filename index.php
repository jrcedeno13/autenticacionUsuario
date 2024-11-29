<?php include("db.php"); ?>
<?php include("includes/header.php"); ?>

<body>
    <nav class="navbar navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="index.php">INICIO DE SESIÓN </a>
      </div>
    </nav>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h3 class="text-center">Ingreso</h3>
                <form action="login.php" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Nombre de usuario:</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="nombre de usuario" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña:</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="contraseña" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100" name="go_login">Entrar</button>
                </form>
                <p class="redirect">No tienes cuenta ? <a href="register.php">Registrate aquí</a></p>
            </div>
        </div>
    </div>

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

<?php include("includes/footer.php"); ?>
