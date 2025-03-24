<div class="container">
    <div class="header" style="font-size: 20px;">
        <h4>Listado de Cursos Generales</h4>
        <div class="header-actions">
            <a href="index.php?controller=course&action=create" class="btn btn-success">
                <i class="fas fa-plus"></i> Crear Curso
            </a>
        </div>
    </div>
    <div class="body">
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert success"><?php echo $_SESSION['success']; ?></div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert error"><?php echo $_SESSION['error']; ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <div class="courses">
            <?php while ($row = $courses->fetch(PDO::FETCH_ASSOC)): ?>
                <div class="course-card">
                    <div class="course-header" style="font-size: 20px;">
                        <h5><?php echo $row['nombre']; ?></h5>
                    </div>
                    <div class="course-body">
                        <img src="index.php?controller=course&action=showIcon&id=<?php echo $row['id']; ?>"
                            alt="Icono del Curso"
                            class="course-icon">
                        <p><strong>Abreviación:</strong> <?php echo $row['abreviacion']; ?></p>
                        <p><strong>Aula:</strong> <?php echo $row['aula']; ?></p>
                        <p><strong>Descripción:</strong> <?php echo $row['descripcion']; ?></p>
                    </div>
                    <div class="course-footer">
                        <?php if ($row['usuario_id'] == $_SESSION['user_id']): ?>
                            <a href="index.php?controller=course&action=edit&id=<?php echo $row['id']; ?>"
                                class="btn edit">Editar</a>
                            <a href="index.php?controller=course&action=delete&id=<?php echo $row['id']; ?>"
                                class="btn delete">Eliminar</a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <!-- Paginación -->
        <?php if($pagination->total_pages() > 1): ?>
            <nav class="pagination-nav">
                <ul class="pagination">
                    <?php if($pagination->has_previous_page()): ?>
                        <li class="page-item">
                            <a class="page-link" href="index.php?controller=course&action=index&page=<?php echo $pagination->previous_page(); ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php for($i = 1; $i <= $pagination->total_pages(); $i++): ?>
                        <li class="page-item <?php echo $pagination->page_number() == $i ? 'active' : ''; ?>">
                            <a class="page-link" href="index.php?controller=course&action=index&page=<?php echo $i; ?>"> <?php echo $i; ?> </a>
                        </li>
                    <?php endfor; ?>
                    <?php if($pagination->has_next_page()): ?>
                        <li class="page-item">
                            <a class="page-link" href="index.php?controller=course&action=index&page=<?php echo $pagination->next_page(); ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
</div>
