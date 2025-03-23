<?php
class AuthController {
    private $db;
    private $user;
    
    public function __construct() {
        // Inicializar conexión a la base de datos
        require_once '../config/database.php';
        $database = new Database();
        $this->db = $database->getConnection();
        
        // Inicializar modelo de usuario
        require_once '../models/User.php';
        $this->user = new User($this->db);
    }
    
    // Mostrar formulario de login
    public function loginForm() {
        // Redirigir si ya está logueado
        if(isset($_SESSION['user_id'])) {
            header('Location: index.php');
            exit;
        }
        
        require_once '../views/templates/header.php';
        require_once '../views/auth/login.php';
        require_once '../views/templates/footer.php';
    }
    
    // Procesar login
    public function login() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->user->email = $_POST['email'];
            $this->user->password = $_POST['password'];
            
            if($this->user->login()) {
                // Iniciar sesión
                $_SESSION['user_id'] = $this->user->id;
                $_SESSION['user_name'] = $this->user->nombre;
                
                // Redirigir al listado de cursos
                header('Location: index.php?controller=course&action=index');
                exit;
            } else {
                // Error de login
                $_SESSION['error'] = 'Email o contraseña incorrectos';
                header('Location: index.php?controller=auth&action=loginForm');
                exit;
            }
        }
    }
    
    // Mostrar formulario de registro
    public function registerForm() {
        // Redirigir si ya está logueado
        if(isset($_SESSION['user_id'])) {
            header('Location: index.php');
            exit;
        }
        
        require_once '../views/templates/header.php';
        require_once '../views/auth/register.php';
        require_once '../views/templates/footer.php';
    }
    
    // Procesar registro
    public function register() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->user->nombre = $_POST['nombre'];
            $this->user->email = $_POST['email'];
            $this->user->password = $_POST['password'];
            
            // Validación básica
            if(empty($this->user->nombre) || empty($this->user->email) || empty($this->user->password)) {
                $_SESSION['error'] = 'Todos los campos son obligatorios';
                header('Location: index.php?controller=auth&action=registerForm');
                exit;
            }
            
            // Crear usuario
            if($this->user->create()) {
                $_SESSION['success'] = 'Registro exitoso, ahora puede iniciar sesión';
                header('Location: index.php?controller=auth&action=loginForm');
                exit;
            } else {
                $_SESSION['error'] = 'No se pudo completar el registro';
                header('Location: index.php?controller=auth&action=registerForm');
                exit;
            }
        }
    }

    public function logout() {
        session_start();
        session_destroy();
    
        // Deshabilitar caché para evitar volver con "atrás"
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
    
        // Redirigir a la página de login
        header("Location: /proyecto_test/public/index.php");
        exit();
    }
}