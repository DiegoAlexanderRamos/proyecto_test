<?php
class CourseController
{
    private $db;
    private $course;
    private $records_per_page = 6; // Número de registros por página

    public function __construct()
    {
        // Verificar si el usuario está logueado
        if (!isset($_SESSION['user_id']) && $_SERVER['REQUEST_METHOD'] !== 'GET') {
            header('Location: index.php?controller=auth&action=loginForm');
            exit;
        }

        // Inicializar conexión a la base de datos
        require_once '../config/database.php';
        $database = new Database();
        $this->db = $database->getConnection();

        // Inicializar modelo de curso
        require_once '../models/Course.php';
        $this->course = new Course($this->db);

        // Cargar utilidad de paginación
        require_once '../utils/Pagination.php';
    }

    /**
     * Función auxiliar para cargar las plantillas
     */
    private function loadTemplate($template_name, $data = [])
    {
        extract($data);
        require_once '../views/templates/' . $template_name . '.php';
    }

    // Listar todos los cursos
    public function index()
    {
        // Obtener parámetro de página
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $from_record_num = ($this->records_per_page * $page) - $this->records_per_page;

        // Obtener los cursos del usuario autenticado
        if (!isset($_SESSION['user_id'])) {
            // Redirigir si no hay usuario autenticado
            header("Location: login.php");
            exit;
        }

        $courses = $this->course->readByUser($_SESSION['user_id'], $from_record_num, $this->records_per_page);
        $total_rows = $this->course->countByUser($_SESSION['user_id']);

        // Crear paginación
        $pagination = new Pagination($page, $this->records_per_page, $total_rows);

        // Cargar vista
        $this->loadTemplate('header');
        $this->loadTemplate('navigation');
        require_once '../views/courses/index.php';
        $this->loadTemplate('footer');
    }

    // Mostrar formulario para crear curso
    public function create()
    {
        $this->loadTemplate('header');
        $this->loadTemplate('navigation');
        require_once '../views/courses/create.php';
        $this->loadTemplate('footer');
    }

    // Procesar creación de curso
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Establecer valores
            $this->course->nombre = $_POST['nombre'];
            $this->course->abreviacion = $_POST['abreviacion'];
            $this->course->aula = $_POST['aula'];
            $this->course->descripcion = $_POST['descripcion'];
            $this->course->usuario_id = $_SESSION['user_id'];

            // Manejar la carga del icono
            if (isset($_FILES['icono']) && $_FILES['icono']['size'] > 0) {
                $this->course->icono = file_get_contents($_FILES['icono']['tmp_name']);
            } else {
                $_SESSION['error'] = 'El icono es obligatorio';
                header('Location: index.php?controller=course&action=create');
                exit;
            }

            // Validación básica
            if (empty($this->course->nombre) || empty($this->course->abreviacion)) {
                $_SESSION['error'] = 'El nombre y la abreviación son obligatorios';
                header('Location: index.php?controller=course&action=create');
                exit;
            }

            // Crear curso
            if ($this->course->create()) {
                $_SESSION['success'] = 'Curso creado con éxito';
                header('Location: index.php?controller=course&action=index');
                exit;
            } else {
                $_SESSION['error'] = 'No se pudo crear el curso';
                header('Location: index.php?controller=course&action=create');
                exit;
            }
        }
    }

    // Mostrar detalles de un curso
    public function view()
    {
        if (isset($_GET['id'])) {
            $this->course->id = $_GET['id'];

            if ($this->course->readOne()) {
                $this->loadTemplate('header');
                $this->loadTemplate('navigation');
                require_once '../views/courses/view.php';
                $this->loadTemplate('footer');
            } else {
                $_SESSION['error'] = 'Curso no encontrado';
                header('Location: index.php?controller=course&action=index');
                exit;
            }
        } else {
            header('Location: index.php?controller=course&action=index');
            exit;
        }
    }

    // Mostrar formulario para editar curso
    public function edit()
    {
        if (isset($_GET['id'])) {
            $this->course->id = $_GET['id'];

            if ($this->course->readOne()) {
                // Verificar que el usuario es propietario del curso
                if ($this->course->usuario_id != $_SESSION['user_id']) {
                    $_SESSION['error'] = 'No tienes permiso para editar este curso';
                    header('Location: index.php?controller=course&action=index');
                    exit;
                }

                $this->loadTemplate('header');
                $this->loadTemplate('navigation');
                require_once '../views/courses/edit.php';
                $this->loadTemplate('footer');
            } else {
                $_SESSION['error'] = 'Curso no encontrado';
                header('Location: index.php?controller=course&action=index');
                exit;
            }
        } else {
            header('Location: index.php?controller=course&action=index');
            exit;
        }
    }

    // Procesar actualización de curso
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Establecer valores
            $this->course->id = $_POST['id'];
            $this->course->nombre = $_POST['nombre'];
            $this->course->abreviacion = $_POST['abreviacion'];
            $this->course->aula = $_POST['aula'];
            $this->course->descripcion = $_POST['descripcion'];
            $this->course->usuario_id = $_SESSION['user_id'];

            // Validación básica
            if (empty($this->course->nombre) || empty($this->course->abreviacion)) {
                $_SESSION['error'] = 'El nombre y la abreviación son obligatorios';
                header('Location: index.php?controller=course&action=edit&id=' . $this->course->id);
                exit;
            }

            // Manejar la carga del icono (opcional en actualización)
            if (isset($_FILES['icono']) && $_FILES['icono']['size'] > 0) {
                $this->course->icono = file_get_contents($_FILES['icono']['tmp_name']);
            }

            // Actualizar curso
            if ($this->course->update()) {
                $_SESSION['success'] = 'Curso actualizado con éxito';
                header('Location: index.php?controller=course&action=view&id=' . $this->course->id);
                exit;
            } else {
                $_SESSION['error'] = 'No se pudo actualizar el curso';
                header('Location: index.php?controller=course&action=edit&id=' . $this->course->id);
                exit;
            }
        }
    }

    // Procesar eliminación de curso
    public function delete()
    {
        if (isset($_GET['id']) && isset($_SESSION['user_id'])) {
            $this->course->id = $_GET['id'];
            $this->course->usuario_id = $_SESSION['user_id'];

            if ($this->course->delete()) {
                $_SESSION['success'] = 'Curso eliminado con éxito';
            } else {
                $_SESSION['error'] = 'No se pudo eliminar el curso';
            }

            header('Location: index.php?controller=course&action=index');
            exit;
        }
    }

    // Mostrar icono de curso
    public function showIcon()
    {
        if (isset($_GET['id'])) {
            $this->course->id = $_GET['id'];

            if ($this->course->readOne()) {
                header("Content-Type: image/jpeg");
                echo $this->course->icono;
            }
        }
    }
}
