<div class="container my-5">
    <div class="login-card">
        <div class="card-header">
            <h4><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</h4>
        </div>
        <div class="card-body">
            <div class="mb-3" style="margin-left: 130px; margin-bottom: 20px;">
                <i class="fas fa-user-circle fa-5x text-secondary"></i>
            </div>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger"><?php echo $_SESSION['error']; ?></div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <form action="index.php?controller=auth&action=login" method="post">
                <div class="form-group">
                    <label for="email"><i class="fas fa-envelope"></i> Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="password"><i class="fas fa-lock"></i> Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="botones" style="display: flex; justify-content: space-between;  margin-bottom: 15px;">
                    <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                    <a href="index.php?controller=auth&action=registerForm" class="btn btn-outline-success btn-sm">
                        <i class="fas fa-user-plus"></i> Registrarse
                    </a>
                </div>

                <div class="text-center" style="text-align: center;">
                    <a href="#" class="btn btn-link text-muted">¿Olvidaste tu contraseña?</a>
                </div>
            </form>
        </div>
    </div>
</div>
