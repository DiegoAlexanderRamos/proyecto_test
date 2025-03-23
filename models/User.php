<?php
class User {
    private $conn;
    private $table_name = "usuarios";
    
    // Propiedades
    public $id;
    public $nombre;
    public $email;
    public $password;
    public $fecha_registro;
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // Crear nuevo usuario
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET nombre = :nombre, 
                      email = :email, 
                      password = :password";
        
        $stmt = $this->conn->prepare($query);
        
        // Sanitizar
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->email = htmlspecialchars(strip_tags($this->email));
        
        // Encriptar contraseña
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
        
        // Bind
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        
        if($stmt->execute()) {
            return true;
        }
        
        return false;
    }
    
    // Verifica usuario para login
    public function login() {
        $query = "SELECT id, nombre, email, password FROM " . $this->table_name . " 
                  WHERE email = :email LIMIT 1";
        
        $stmt = $this->conn->prepare($query);
        
        $this->email = htmlspecialchars(strip_tags($this->email));
        
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();
        
        if($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if(password_verify($this->password, $row['password'])) {
                $this->id = $row['id'];
                $this->nombre = $row['nombre'];
                return true;
            }
        }
        
        return false;
    }
    
    // Cambiar contraseña
    public function updatePassword() {
        $query = "UPDATE " . $this->table_name . "
                  SET password = :password
                  WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
        
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':id', $this->id);
        
        if($stmt->execute()) {
            return true;
        }
        
        return false;
    }
    
    // Eliminar cuenta
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        
        if($stmt->execute()) {
            return true;
        }
        
        return false;
    }
}