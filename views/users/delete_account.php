<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header ">
                    <h4 class="mb-0"><i class="fas fa-exclamation-triangle"></i> Eliminar Cuenta</h4>
                </div>
                <div class="card-body">
                    <?php if(isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger text-center">
                            <?php echo $_SESSION['error']; ?>
                        </div>
                        <?php unset($_SESSION['error']); ?>
                    <?php endif; ?>

                    <div class="alert alert-warning text-center">
                        <strong>⚠️ Advertencia:</strong> Esta acción es irreversible. Todos sus datos serán eliminados permanentemente.
                    </div>

                    <form action="index.php?controller=user&action=deleteAccount" method="post">
                        <div class="form-group">
                            <label for="password" class="font-weight-bold">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <div class="form-group">
                            <label for="confirmation" class="font-weight-bold">Escriba <span class="text-danger">"DELETE"</span> para confirmar</label>
                            <input type="text" class="form-control" id="confirmation" name="confirmation" placeholder='Escriba "DELETE" aquí' required>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn delete">
                                <i class="fas fa-trash-alt"></i> Eliminar Cuenta
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
