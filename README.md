# SIGP - Sistema Integral de Gestión de Pasantías

SIGP es una plataforma web desarrollada en PHP (MVC) para la gestión eficiente de pasantías, vinculando a estudiantes, empresas e instituciones educativas.

## Características Principales

*   **Gestión de Usuarios Multi-Rol**:
    *   **Administrador**: Control total del sistema.
    *   **Coordinador**: Gestión de estudiantes por institución.
    *   **Tutor Académico**: Supervisión de prácticas.
    *   **Empresa**: Gestión de ofertas y pasantes.
    *   **Estudiante**: Perfil completo (CV, Habilidades) y seguimiento de pasantía.
*   **Gestión de Entidades**:
    *   Módulo de Empresas (CRUD, Geolocalización).
    *   Módulo de Instituciones Educativas.
*   **Gestión de Pasantías**:
    *   Asignación de pasantías (Estudiante <-> Empresa).
    *   Notificaciones automáticas de asignación.
*   **Sistema de Notificaciones**: Alertas en tiempo real para usuarios.

## Requisitos

*   Servidor Web (Apache/Nginx)
*   PHP 7.4 o superior
*   MySQL / MariaDB
*   Composer (Opcional)

## Instalación

1.  Clonar el repositorio:
    ```bash
    git clone https://github.com/pandamigo182/SIGP.git
    ```
2.  Importar la base de datos:
    *   Cree una base de datos llamada `sigp_db`.
    *   Importe el archivo `sigp_db.sql` (si está disponible) o ejecute las migraciones PHP:
        ```bash
        php migrate_student_profile.php
        php migrate_entities.php
        php migrate_notifications.php
        ```
3.  Configurar la conexión:
    *   Edite `app/config/config.php` con sus credenciales de base de datos.

## Credenciales de Acceso (Demo)

*   **Admin**: `admin@sigp.com` / `123456`
*   **Estudiante**: `student@sigp.com` / `123456`
*   **Empresa**: `tech@solutions.com` / `123456`

## Tecnologías

*   PHP (Vanilla MVC Framework)
*   MySQL
*   Bootstrap 5
*   FontAwesome
*   SweetAlert2
