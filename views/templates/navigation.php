<nav class="navbar">
    <div class="container">
        <a class="navbar-brand" href="index.php?controller=course&action=index">
            <i class="fas fa-graduation-cap"></i> Gestión de Cursos
        </a>
        <div class="navbar-menu">
            <ul>
                <li><a href="index.php?controller=course&action=index"><i class="fas fa-book"></i> Cursos</a></li>
                <li class="dropdown">
                    <a href="#"><i class="fas fa-user-cog"></i> Cuenta</a>
                    <div class="dropdown-content">
                        <a href="index.php?controller=user&action=changePasswordForm"><i class="fas fa-key"></i> Cambiar Contraseña</a>
                        <a href="index.php?controller=user&action=deleteAccountForm"><i class="fas fa-user-slash"></i> Eliminar Cuenta</a>
                    </div>
                </li>
                <?php if(isset($_SESSION['user_id'])): ?>
                    <li><a href="#" id="logoutBtn"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
                <?php else: ?>
                    <li><a href="index.php?controller=auth&action=loginForm"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</a></li>
                    <li><a href="index.php?controller=auth&action=registerForm"><i class="fas fa-user-plus"></i> Registrarse</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Modal de Confirmación de Cierre de Sesión -->
<div class="modal" id="logoutModal">
    <div class="modal-content">
        <div class="modal-header">
            <h5><i class="fas fa-sign-out-alt"></i> Confirmar Cierre de Sesión</h5>
            <span class="close">&times;</span>
        </div>
        <div class="modal-body">
            <p>¿Estás seguro de que deseas cerrar sesión?</p>
        </div>
        <div class="modal-footer">
            <a href="index.php?controller=auth&action=logout" class="btn confirm-btn">Sí, Cerrar Sesión</a>
        </div>
    </div>
</div>
