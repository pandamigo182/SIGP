# Sistema Integral de Gestión de Pasantías (SIGP)

![Logo SIGP](public/img/logo-completo.svg)

## Descripción
SIGP es una plataforma web desarrollada en PHP (MVC) diseñada para optimizar y gestionar el ciclo completo de pasantías universitarias, desde la publicación de ofertas hasta la certificación final del estudiante.

---

## 🚀 Características Principales

### 👨‍🎓 Módulo de Estudiantes
*   **Perfil Profesional**: Gestión de CV y habilidades.
*   **Búsqueda Avanzada**: Filtrado de pasantías por ubicación, modalidad (Remoto/Híbrido) y área.
*   **Gestión de Pasantías**: Seguimiento de estado (Activa/Finalizada).
*   **Certificación**: Descarga automática de constancias en PDF tras finalizar y brindar feedback.

### 🏢 Módulo de Empresas
*   **Gestión de Plazas**: Publicación de ofertas con ciclo de vida configurable.
*   **Selección de Talento**: Revisión de perfiles y aceptación/rechazo de postulantes.
*   **Seguimiento**: Panel "Mis Pasantes" para gestionar pasantías activas.
*   **Evaluación y Finalización**: Herramienta integrada para evaluar competencias y finalizar pasantías, generando notificaciones automáticas.

### 🛡️ Módulo Administrativo
*   **Gestión de Usuarios y Roles**: Control total sobre Estudiantes, Empresas y Tutores.
*   **Configuración del Sistema**: Ajustes de contacto, logos y mapas.
*   **Diplomas**: Gestión de plantillas para certificados automáticos.
*   **Bitácora y Reportes**: Auditoría de acciones y métricas del sistema.

---

## ⚙️ Configuración e Instalación

### Requisitos Previos
*   **Servidor Web**: Apache (XAMPP/WAMP recomendado).
*   **PHP**: Versión 7.4 o superior (Compatible con 8.1+).
*   **Base de Datos**: MySQL / MariaDB.
*   **Librerías**: `FPDF` (Ya incluida en `app/lib`).

### Guía Paso a Paso
1.  **Despliegue de Archivos**:
    *   Clonar o copiar el proyecto en la carpeta pública del servidor (ej: `C:\xampp\htdocs\SIGP`).

2.  **Base de Datos**:
    *   Crear una base de datos vacía (ej: `sigp_db`).
    *   Importar el archivo SQL completo ubicado en:
        `public/databases/sigp_complete.sql`
        *(Este archivo contiene la estructura completa, roles, usuarios admin por defecto y catálogos geográficos)*.

3.  **Configuración de Entorno**:
    *   Editar archivo: `app/config/config.php`
    *   Ajustar credenciales:
        ```php
        define('DB_HOST', 'localhost');
        define('DB_USER', 'tu_usuario'); // Por defecto 'root'
        define('DB_PASS', 'tu_password'); // Por defecto '' o 'root'
        define('DB_NAME', 'sigp_db');
        ```

4.  **Verificación**:
    *   Acceder a `http://localhost/SIGP`.
    *   Credenciales Admin por defecto (si se usó seeders):
        *   User: `admin@sigp.com`
        *   Pass: `admin123`

---

## 🔒 Seguridad
El sistema implementa:
*   **Sanitización de Entradas**: Uso de `filter_input` para prevenir XSS.
*   **Sentencias Preparadas**: PDO para evitar Inyecciones SQL.
*   **Control de Acceso (RBAC)**: Middleware de verificación de roles por controlador.
*   **Validación de Archivos**: Restricciones de tipo y ubicación para subidas (CVs, Imágenes).

---

## 📄 Estructura de Base de Datos
Tablas principales del sistema:
*   `usuarios`, `roles`: Autenticación y Autorización.
*   `empresas`, `estudiantes`: Perfiles extendidos.
*   `plazas`, `postulaciones`: Mercado de ofertas.
*   `pasantias`: Ciclo de vida de la práctica.
*   `evaluaciones_empresa`, `evaluaciones_estudiante`: Sistema de Feedback 360°.
*   `certificados_plantillas`: Motor de diplomas.

---

## Soporte
Para soporte técnico o reportar vulnerabilidades, contactar al administrador del sistema.

&copy; 2026 SIGP - Sistema Integral de Gestión de Pasantías.
