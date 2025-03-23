<?php
class UserController {
    private $db;
    private $user;
    
    public function __construct() {
        // Verificar si el usuario está logueado
        if(!isset($_SESSION['user_id'])) {
            header('Location: index.php?controller=auth&action=loginForm');
            exit;
        }
        
        // Inicializar conexión a la base de datos
        require_once '../config/database.php';
        $database = new Database();
        $this->db = $database->getConnection();
        
        // Inicializar modelo de usuario
        require_once '../models/User.php';
        $this->user = new User($this->db);
        $this->user->id = $_SESSION['user_id'];
    }
    
    // Mostrar formulario para cambiar contraseña
    public function changePasswordForm() {
        require_once '../views/templates/header.php';
        require_once '../views/templates/navigation.php';
        require_once '../views/auth/change_password.php';
        require_once '../views/templates/footer.php';
    }
    
    // Procesar cambio de contraseña
    public function changePassword() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $current_password = $_POST['current_password'];
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];
            
            // Validación básica
            if(empty($current_password) || empty($new_password) || empty($confirm_password)) {
                $_SESSION['error'] = 'Todos los campos son obligatorios';
                header('Location: index.php?controller=user&action=changePasswordForm');
                exit;
            }
            
            if($new_password !== $confirm_password) {
                $_SESSION['error'] = 'Las contraseñas nuevas no coinciden';
                header('Location: index.php?controller=user&action=changePasswordForm');
                exit;
            }
            
            // Verificar contraseña actual
            $this->user->password = $current_password;
            $this->user->email = $this->getEmail();
            
            if($this->user->login()) {
                // Actualizar contraseña
                $this->user->password = $new_password;
                
                if($this->user->updatePassword()) {
                    $_SESSION['success'] = 'Contraseña actualizada con éxito';
                    header('Location: index.php?controller=course&action=index');
                    exit;
                } else {
                    $_SESSION['error'] = 'No se pudo actualizar la contraseña';
                }
            } else {
                $_SESSION['error'] = 'La contraseña actual es incorrecta';
            }
            
            header('Location: index.php?controller=user&action=changePasswordForm');
            exit;
        }
    }
    
    // Obtener email del usuario actual
    private function getEmail() {
        $query = "SELECT email FROM usuarios WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $this->user->id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['email'];
    }
    
    // Mostrar confirmación para eliminar cuenta
    public function deleteAccountForm() {
        require_once '../views/templates/header.php';
        require_once '../views/templates/navigation.php';
        require_once '../views/users/delete_account.php';
        require_once '../views/templates/footer.php';
    }
    
    // Procesar eliminación de cuenta
    public function deleteAccount() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $password = $_POST['password'];
            $confirmation = $_POST['confirmation'];
            
            if($confirmation != 'DELETE') {
                $_SESSION['error'] = 'Confirmación incorrecta';
                header('Location: index.php?controller=user&action=deleteAccountForm');
                exit;
            }
            
            // Verificar contraseña
            $this->user->password = $password;
            $this->user->email = $this->getEmail();
            
            if($this->user->login()) {
                if($this->user->delete()) {
                    // Destruir sesión
                    session_unset();
                    session_destroy();
                    
                    // Redireccionar al login con mensaje
                    session_start();
                    $_SESSION['success'] = 'Cuenta eliminada con éxito';
                    header('Location: index.php?controller=auth&action=loginForm');
                    exit;
                } else {
                    $_SESSION['error'] = 'No se pudo eliminar la cuenta';
                }
            } else {
                $_SESSION['error'] = 'Contraseña incorrecta';
            }
            
            header('Location: index.php?controller=user&action=deleteAccountForm');
            exit;
        }
    }
}