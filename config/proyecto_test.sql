-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS proyecto_test;
USE proyecto_test;

-- Tabla de usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de cursos
CREATE TABLE IF NOT EXISTS cursos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    abreviacion VARCHAR(20) NOT NULL,
    aula VARCHAR(50),
    descripcion TEXT,
    icono LONGBLOB NOT NULL,
    usuario_id INT NOT NULL, -- Asegura que siempre tenga un usuario asignado
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

SELECT * FROM cursos ; 
SELECT * FROM usuarios ; 