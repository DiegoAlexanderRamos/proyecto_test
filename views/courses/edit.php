<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header bg-warning text-white text-center">
                    <h4 class="mb-0">Editar Curso</h4>
                </div>
                <div class="card-body">
                    <?php if(isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger text-center"><?php echo $_SESSION['error']; ?></div>
                        <?php unset($_SESSION['error']); ?>
                    <?php endif; ?>
                    <form action="index.php?controller=course&action=update" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $this->course->id; ?>">
                        <div class="form-group">
                            <label for="nombre" class="font-weight-bold">Nombre</label>
                            <input type="text" class="form-control rounded-pill" id="nombre" name="nombre" value="<?php echo $this->course->nombre; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="abreviacion" class="font-weight-bold">Abreviación</label>
                            <input type="text" class="form-control rounded-pill" id="abreviacion" name="abreviacion" value="<?php echo $this->course->abreviacion; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="aula" class="font-weight-bold">Aula</label>
                            <input type="text" class="form-control rounded-pill" id="aula" name="aula" value="<?php echo $this->course->aula; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcion" class="font-weight-bold">Descripción</label>
                            <textarea class="form-control rounded" id="descripcion" name="descripcion" rows="3" required><?php echo $this->course->descripcion; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="icono" class="font-weight-bold">Actualizar Icono (opcional)</label>
                            <input type="file" class="form-control-file" id="icono" name="icono">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success btn-lg rounded-pill px-4 shadow-sm">
                                <i class="fas fa-edit"></i> Actualizar Curso
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
