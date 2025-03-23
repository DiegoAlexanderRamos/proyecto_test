# Proyecto de Gestión de Cursos

## Descripción

Este es un sistema de gestión de cursos desarrollado en PHP con MySQL, utilizando el patrón MVC para una mejor organización del código. Permite la administración de usuarios y cursos, con autenticación de usuarios, gestión de sesiones y paginación de cursos.

## Características

- Registro e inicio de sesión de usuarios.
- Cambio de contraseña y eliminación de cuenta.
- Creación, edición, visualización y eliminación de cursos.
- Paginación en la lista de cursos.
- Sistema de sesiones para la gestión de autenticación.
- Diseño responsivo con Bootstrap.

## Estructura del Proyecto

```
/proyecto_test
│
├── config/
│   └── database.php           // Configuración de conexión a MySQL
│   └── proyecto_test.sql      // Archivo SQL de la creacion de la BD y Tablas
│
├── controllers/
│   ├── UserController.php     // Controlador para gestión de usuarios
│   ├── CourseController.php   // Controlador para gestión de cursos
│   └── AuthController.php     // Controlador para autenticación
│
├── models/
│   ├── User.php               // Modelo para usuarios
│   └── Course.php             // Modelo para cursos
│
├── views/
│   ├── auth/
│   │   ├── login.php          // Formulario de login
│   │   ├── register.php       // Formulario de registro
│   │   └── change_password.php // Cambio de contraseña
│   │
│   ├── courses/
│   │   ├── index.php          // Listado de cursos con paginación
│   │   ├── create.php         // Formulario para crear curso
│   │   ├── edit.php           // Formulario para editar curso
│   │   └── view.php           // Vista detallada de un curso
│   │
│   ├── users/
│   │   └── delete_account.php // Confirmación para eliminar cuenta
│   │
│   ├── templates/
│   │   ├── header.php         // Cabecera común
│   │   ├── footer.php         // Pie común
│   │   └── navigation.php     // Menú de navegación
│
├── public/
│   ├── index.php              // Punto de entrada
│   ├── css/                   // Estilos CSS
│   ├── js/                    // JavaScript
│   └── uploads/               // Almacenamiento de iconos de cursos
│
├── utils/
│   ├── Pagination.php         // Clase para manejar paginación
│   └── Session.php            // Gestión de sesiones
│
└── .htaccess                  // Configuración para URL amigables
```

### Requisitos

- Servidor Apache con soporte para PHP.
- MySQL para la base de datos.

### Pasos

1. Clonar el repositorio:
   ```bash
   git clone https://github.com/tu-usuario/proyecto_test.git
   ```
2. Configurar la base de datos:
   - Crear una base de datos en MySQL.
   - Importar el archivo `proyecto_test.sql` si está disponible.
   - Configurar las credenciales en `config/database.php`.
3. Asegurar permisos adecuados para la carpeta `uploads/`.
4. Configurar el servidor virtual para apuntar a `public/index.php` o acceder a través de:
   ```
   http://localhost/proyecto_test/public/index.php
   ```

## Uso

- **Inicio de sesión**: Accede a `http://localhost/proyecto_test/public/index.php?controller=auth&action=loginForm`.
- **Registro de usuario**: Accede a `http://localhost/proyecto_test/public/index.php?controller=auth&action=registerForm`.
- **Gestión de cursos**: Después de iniciar sesión, puedes ver los cursos en `http://localhost/proyecto_test/public/index.php?controller=course&action=index`.


