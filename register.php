<?php include("db.php"); ?>
<?php include("includes/header.php"); ?>

<body>
    <nav class="navbar navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="index.php">REGISTRO DE USUARIO NUEVO</a>
      </div>
    </nav>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h3 class="text-center">Registro de usuario.</h3>
                <form action="save_user.php" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Nombre de usuario:</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="nombre de usuario" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña:</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="contraseña" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirmar contraseña:</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="confirmar contraseña" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100" name="save_user">Guardar usuario</button>
                </form>
                <p class="redirect">¿Ya tienes una cuenta? <a href="index.php">Inicia sesión aquí.</a></p>
            </div>
        </div>
    </div>

    <script>
        // Verificar si las contraseñas coinciden
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

<?php include("includes/footer.php"); ?>
