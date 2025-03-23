<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-primary">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0"><i class="fas fa-key"></i> Cambiar Contraseña</h4>
                </div>
                <div class="card-body">
                    <?php if(isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger text-center">
                            <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['error']; ?>
                        </div>
                        <?php unset($_SESSION['error']); ?>
                    <?php endif; ?>

                    <?php if(isset($_SESSION['success'])): ?>
                        <div class="alert alert-success text-center">
                            <i class="fas fa-check-circle"></i> <?php echo $_SESSION['success']; ?>
                        </div>
                        <?php unset($_SESSION['success']); ?>
                    <?php endif; ?>

                    <form action="index.php?controller=user&action=changePassword" method="post">
                        <div class="form-group">
                            <label for="current_password" class="font-weight-bold">Contraseña Actual</label>
                            <input type="password" class="form-control rounded-pill" id="current_password" name="current_password" placeholder="Ingrese su contraseña actual" required>
                        </div>

                        <div class="form-group">
                            <label for="new_password" class="font-weight-bold">Nueva Contraseña</label>
                            <input type="password" class="form-control rounded-pill" id="new_password" name="new_password" placeholder="Ingrese su nueva contraseña" required>
                        </div>

                        <div class="form-group">
                            <label for="confirm_password" class="font-weight-bold">Confirmar Nueva Contraseña</label>
                            <input type="password" class="form-control rounded-pill" id="confirm_password" name="confirm_password" placeholder="Repita la nueva contraseña" required>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill px-4 shadow-sm">
                                <i class="fas fa-sync-alt"></i> Cambiar Contraseña
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
