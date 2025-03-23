<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">Crear Curso</h4>
                </div>
                <div class="card-body">
                    <?php if(isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger text-center"><?php echo $_SESSION['error']; ?></div>
                        <?php unset($_SESSION['error']); ?>
                    <?php endif; ?>
                    <form action="index.php?controller=course&action=store" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nombre" class="font-weight-bold">Nombre</label>
                            <input type="text" class="form-control rounded-pill" id="nombre" name="nombre" placeholder="Ingrese el nombre del curso" required>
                        </div>
                        <div class="form-group">
                            <label for="abreviacion" class="font-weight-bold">Abreviación</label>
                            <input type="text" class="form-control rounded-pill" id="abreviacion" name="abreviacion" placeholder="Ej: MAT101" required>
                        </div>
                        <div class="form-group">
                            <label for="aula" class="font-weight-bold">Aula</label>
                            <input type="text" class="form-control rounded-pill" id="aula" name="aula" placeholder="Ej: A101" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcion" class="font-weight-bold">Descripción</label>
                            <textarea class="form-control rounded" id="descripcion" name="descripcion" rows="3" placeholder="Describa el curso" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="icono" class="font-weight-bold">Icono del Curso</label>
                            <input type="file" class="form-control-file" id="icono" name="icono" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success btn-lg rounded-pill px-4 shadow-sm">
                                <i class="fas fa-save"></i> Crear Curso
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
