<?php
class Course {
    private $conn;
    private $table_name = "cursos";
    
    // Propiedades
    public $id;
    public $nombre;
    public $abreviacion;
    public $aula;
    public $descripcion;
    public $icono;
    public $usuario_id;
    public $fecha_creacion;
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // Crear un nuevo curso
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET nombre = :nombre,
                      abreviacion = :abreviacion,
                      aula = :aula,
                      descripcion = :descripcion,
                      icono = :icono,
                      usuario_id = :usuario_id";
        
        $stmt = $this->conn->prepare($query);
        
        // Sanitizar
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->abreviacion = htmlspecialchars(strip_tags($this->abreviacion));
        $this->aula = htmlspecialchars(strip_tags($this->aula));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        
        // Bind
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":abreviacion", $this->abreviacion);
        $stmt->bindParam(":aula", $this->aula);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":icono", $this->icono, PDO::PARAM_LOB);
        $stmt->bindParam(":usuario_id", $this->usuario_id);
        
        if($stmt->execute()) {
            return true;
        }
        
        return false;
    }
    
    // Leer todos los cursos con paginación
    public function readAll($from_record_num, $records_per_page) {
        $query = "SELECT c.*, u.nombre as creador
                FROM " . $this->table_name . " c
                JOIN usuarios u ON c.usuario_id = u.id
                ORDER BY c.fecha_creacion DESC
                LIMIT ?, ?";
    
        $stmt = $this->conn->prepare($query);
        
        // Bind valores para paginación
        $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
        
        $stmt->execute();
        
        return $stmt;
    }
    
    // Leer todos los cursos de un usuario específico
    public function readByUser($usuario_id, $from_record_num, $records_per_page) {
        $query = "SELECT * FROM " . $this->table_name . "
                WHERE usuario_id = ?
                ORDER BY fecha_creacion DESC
                LIMIT ?, ?";
    
        $stmt = $this->conn->prepare($query);
        
        // Bind valores
        $stmt->bindParam(1, $usuario_id);
        $stmt->bindParam(2, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(3, $records_per_page, PDO::PARAM_INT);
        
        $stmt->execute();
        
        return $stmt;
    }
    
    // Contar cursos para paginación
    public function count() {
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name;
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $row['total_rows'];
    }
    
    // Contar cursos de un usuario para paginación
    public function countByUser($usuario_id) {
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . " WHERE usuario_id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $usuario_id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $row['total_rows'];
    }
    
    // Leer un curso específico
    public function readOne() {
        $query = "SELECT c.*, u.nombre as creador
                FROM " . $this->table_name . " c
                JOIN usuarios u ON c.usuario_id = u.id
                WHERE c.id = ?
                LIMIT 0,1";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($row) {
            $this->id = $row['id'];
            $this->nombre = $row['nombre'];
            $this->abreviacion = $row['abreviacion'];
            $this->aula = $row['aula'];
            $this->descripcion = $row['descripcion'];
            $this->icono = $row['icono'];
            $this->usuario_id = $row['usuario_id'];
            $this->fecha_creacion = $row['fecha_creacion'];
            return true;
        }
        
        return false;
    }
    
    // Actualizar un curso
    public function update() {
        // Si no se sube un nuevo icono
        if(empty($this->icono)) {
            $query = "UPDATE " . $this->table_name . "
                    SET nombre = :nombre,
                        abreviacion = :abreviacion,
                        aula = :aula,
                        descripcion = :descripcion
                    WHERE id = :id
                    AND usuario_id = :usuario_id";
                    
            $stmt = $this->conn->prepare($query);
            
            // Sanitizar
            $this->nombre = htmlspecialchars(strip_tags($this->nombre));
            $this->abreviacion = htmlspecialchars(strip_tags($this->abreviacion));
            $this->aula = htmlspecialchars(strip_tags($this->aula));
            $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
            $this->id = htmlspecialchars(strip_tags($this->id));
            
            // Bind
            $stmt->bindParam(":nombre", $this->nombre);
            $stmt->bindParam(":abreviacion", $this->abreviacion);
            $stmt->bindParam(":aula", $this->aula);
            $stmt->bindParam(":descripcion", $this->descripcion);
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":usuario_id", $this->usuario_id);
        }
        // Si se sube un nuevo icono
        else {
            $query = "UPDATE " . $this->table_name . "
                    SET nombre = :nombre,
                        abreviacion = :abreviacion,
                        aula = :aula,
                        descripcion = :descripcion,
                        icono = :icono
                    WHERE id = :id
                    AND usuario_id = :usuario_id";
                    
            $stmt = $this->conn->prepare($query);
            
            // Sanitizar
            $this->nombre = htmlspecialchars(strip_tags($this->nombre));
            $this->abreviacion = htmlspecialchars(strip_tags($this->abreviacion));
            $this->aula = htmlspecialchars(strip_tags($this->aula));
            $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
            $this->id = htmlspecialchars(strip_tags($this->id));
            
            // Bind
            $stmt->bindParam(":nombre", $this->nombre);
            $stmt->bindParam(":abreviacion", $this->abreviacion);
            $stmt->bindParam(":aula", $this->aula);
            $stmt->bindParam(":descripcion", $this->descripcion);
            $stmt->bindParam(":icono", $this->icono, PDO::PARAM_LOB);
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":usuario_id", $this->usuario_id);
        }
        
        if($stmt->execute()) {
            return true;
        }
        
        return false;
    }
    
    // Eliminar un curso
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " 
                  WHERE id = ? 
                  AND usuario_id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->bindParam(2, $this->usuario_id);
        
        if($stmt->execute()) {
            return true;
        }
        
        return false;
    }
}