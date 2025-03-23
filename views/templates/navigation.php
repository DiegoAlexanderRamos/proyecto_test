<nav class="navbar navbar-expand-lg">
    <div class="container" style="font-size: 20px;">
        <a class="navbar-brand" href="index.php?controller=course&action=index" style="color: black; font-size: 30px; font-weight: bold;">
            <i class="fas fa-graduation-cap"></i> Gestión de Cursos
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item" style="padding-left: 10px;">
                    <a class="nav-link" href="index.php?controller=course&action=index" style="color: black;">
                        <i class="fas fa-book"></i> Cursos
                    </a>
                </li>
                <li class="nav-item dropdown" style="padding-left: 10px;">
                    <a class="nav-link dropdown-toggle" href="#" id="userMenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: black;">
                        <i class="fas fa-user-cog"></i> Cuenta
                    </a>
                    <div class="dropdown-menu" aria-labelledby="userMenu">
                        <a class="dropdown-item" href="index.php?controller=user&action=changePasswordForm">
                            <i class="fas fa-key"></i> Cambiar Contraseña
                        </a>
                        <a class="dropdown-item" href="index.php?controller=user&action=deleteAccountForm">
                            <i class="fas fa-user-slash"></i> Eliminar Cuenta
                        </a>
                    </div>
                </li>

                <?php if(isset($_SESSION['user_id'])): ?>
                    <li class="nav-item" style="padding-left: 10px;">
                        <!-- Botón que activa el modal -->
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal" style="color: black;">
                            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item" style="padding-left: 10px;">
                        <a class="nav-link" href="index.php?controller=auth&action=loginForm">
                            <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=auth&action=registerForm">
                            <i class="fas fa-user-plus"></i> Registrarse
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Modal de Confirmación de Cierre de Sesión -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="logoutModalLabel"><i class="fas fa-sign-out-alt"></i> Confirmar Cierre de Sesión</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <p>¿Estás seguro de que deseas cerrar sesión?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> No</button>
                <a href="index.php?controller=auth&action=logout" class="btn btn-danger"><i class="fas fa-check"></i> Sí, Cerrar Sesión</a>
            </div>
        </div>
    </div>
</div>
