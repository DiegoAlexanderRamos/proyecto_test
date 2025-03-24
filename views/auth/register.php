<div class="container my-5">
    <div class="register-card">
        <div class="card-header">
            <h4><i class="fas fa-user-plus"></i> Crear Cuenta</h4>
        </div>
        <div class="card-body">
            <div class="mb-3" style="margin-left: 130px; margin-bottom: 20px;">
                <i class="fas fa-user-circle fa-5x text-secondary"></i>
            </div>

            <?php if(isset($_SESSION['error'])): ?>
                <div class="alert alert-danger"><?php echo $_SESSION['error']; ?></div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <form action="index.php?controller=auth&action=register" method="post">
                <div class="form-group">
                    <label for="nombre"><i class="fas fa-user"></i> Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>

                <div class="form-group">
                    <label for="email"><i class="fas fa-envelope"></i> Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="password"><i class="fas fa-lock"></i> Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success" style="width: 100%;">Registrarse</button>
                </div>

                <div class="text-center">
                    <a href="index.php?controller=auth&action=loginForm" class="btn btn-outline-primary btn-sm" style="width: 90%;">
                        <i class="fas fa-sign-in-alt"></i> ¿Ya tienes una cuenta? Inicia sesión
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
