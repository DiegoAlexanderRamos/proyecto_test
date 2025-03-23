<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Listado de Cursos Generales</h4>
                    <div class="d-flex align-items-center">
                        <a href="index.php?controller=course&action=create" class="btn btn-success mr-2">
                            <i class="fas fa-plus"></i> Crear Curso
                        </a>
                        <div class="dropdown">
                            <a class="btn btn-light dropdown-toggle" href="#" id="userMenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user-cog"></i> Cursos
                            </a>
                            <div class="dropdown-menu" aria-labelledby="userMenu">
                                <a href="index.php?controller=course&action=index&user_courses=1" class="dropdown-item">
                                    <i class="fas fa-filter"></i> Mis Cursos
                                </a>
                                <a class="dropdown-item" href="index.php?controller=course&action=index">
                                    <i class="fas fa-book"></i> Cursos
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success"><?php echo $_SESSION['success']; ?></div>
                        <?php unset($_SESSION['success']); ?>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger"><?php echo $_SESSION['error']; ?></div>
                        <?php unset($_SESSION['error']); ?>
                    <?php endif; ?>

                    <div class="row">
                        <?php while ($row = $courses->fetch(PDO::FETCH_ASSOC)): ?>
                            <div class="col-md-4 mb-4">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-header text-center bg-primary text-white">
                                        <h5 class="mb-0"><?php echo $row['nombre']; ?></h5>
                                    </div>
                                    <div class="card-body text-center">
                                        <img src="index.php?controller=course&action=showIcon&id=<?php echo $row['id']; ?>"
                                            alt="Icono del Curso"
                                            class="img-fluid rounded mb-3"
                                            style="max-height: 150px;">
                                        <p><strong>Abreviación:</strong> <?php echo $row['abreviacion']; ?></p>
                                        <p><strong>Aula:</strong> <?php echo $row['aula']; ?></p>
                                        <p><strong>Descripción:</strong> <?php echo $row['descripcion']; ?></p>
                                    </div>
                                    <div class="card-footer text-center">
                                        <a href="index.php?controller=course&action=view&id=<?php echo $row['id']; ?>"
                                            class="btn btn-primary btn-sm">Ver detalles</a>
                                        <?php if ($row['usuario_id'] == $_SESSION['user_id']): ?>
                                            <a href="index.php?controller=course&action=edit&id=<?php echo $row['id']; ?>"
                                                class="btn btn-secondary btn-sm">Editar</a>
                                            <a href="index.php?controller=course&action=delete&id=<?php echo $row['id']; ?>"
                                                class="btn btn-danger btn-sm">Eliminar</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>

                    <!-- Paginación -->
                    <?php if($pagination->total_pages() > 1): ?>
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center">
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
        </div>
    </div>
</div>