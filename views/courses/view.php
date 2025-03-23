<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Detalles del Curso</h4>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <img src="index.php?controller=course&action=showIcon&id=<?php echo $this->course->id; ?>" alt="Icono del Curso" class="img-fluid" style="max-height: 200px;">
                    </div>
                    <h5>Nombre: <?php echo $this->course->nombre; ?></h5>
                    <p>Abreviación: <?php echo $this->course->abreviacion; ?></p>
                    <p>Aula: <?php echo $this->course->aula; ?></p>
                    <p>Descripción: <?php echo $this->course->descripcion; ?></p>
                    <p>Fecha de Creación: <?php echo $this->course->fecha_creacion; ?></p>
                    <?php if($this->course->usuario_id == $_SESSION['user_id']): ?>
                        <div class="mt-3">
                            <a href="index.php?controller=course&action=edit&id=<?php echo $this->course->id; ?>" class="btn btn-secondary">Editar</a>
                            <a href="index.php?controller=course&action=delete&id=<?php echo $this->course->id; ?>" class="btn btn-danger">Eliminar</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
