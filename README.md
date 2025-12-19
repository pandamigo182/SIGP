# Sistema Integral de Gestión de Pasantías (SIGP)

![Banner SIGP](public/img/logo-completo.svg)

![Version](https://img.shields.io/badge/version-2.0.0-blue.svg?style=flat-square)
![PHP](https://img.shields.io/badge/PHP-%5E7.4%20%7C%7C%20%5E8.0-777bb4.svg?style=flat-square&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479a1.svg?style=flat-square&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952b3.svg?style=flat-square&logo=bootstrap&logoColor=white)
![License](https://img.shields.io/badge/license-Proprietary-red.svg?style=flat-square)

> **Plataforma Enterprise** para la orquestación del ciclo de vida de prácticas profesionales. Diseñada con enfoque en seguridad, escalabilidad y experiencia de usuario.

---

## 🚀 Características Principales

### 👨‍🎓 **Panel del Estudiante**
- **Perfil Profesional 360°**: Gestión de Curriculum Vitae, habilidades técnicas y blandas.
- **Búsqueda Inteligente**: Filtrado de ofertas por geolocalización, modalidad (Remoto/Híbrido) y área profesional.
- **Workflow de Pasantía**: Seguimiento en tiempo real desde la postulación hasta la certificación.
- **Certificación Automatizada**: Generación de constancias PDF con firma digital al completar exitosamente.

### 🏢 **Portal Corporativo (Empresas)**
- **Publicación de Vacantes**: Asistente para creación de plazas con perfiles detallados.
- **Gestión de Talento**: ATS (Applicant Tracking System) ligero para evaluar candidatos.
- **Evaluación de Desempeño**: Herramientas integradas para realizar evaluaciones de medio y final de término.

### 🛡️ **Núcleo Administrativo**
- **Gestión RBAC**: Control de acceso basado en roles granular (Admin, Empresa, Estudiante, Tutor).
- **Auditoría & Logs**: Trazabilidad completa de acciones críticas del sistema.
- **Motor de Plantillas**: Editor de diplomas y certificados dinámicos.

---

## 🛠️ Stack Tecnológico

*   **Backend**: PHP 8 (Arquitectura MVC Custom sin Frameworks pesados).
*   **Frontend**: Bootstrap 5, CSS Variables, Vanilla JS (ES6+).
*   **Base de Datos**: MySQL / MariaDB con diseño relacional (Foreign Keys strict).
*   **Seguridad**:
    *   Sanitización de I/O (Input/Output).
    *   Protección CSRF Global.
    *   Sentencias Preparadas (PDO) anti-SQLi.
    *   Gestión de secretos vía `.env`.

---

## ⚙️ Guía de Instalación

### Requisitos
*   PHP 7.4 o superior
*   Composer (Opcional, para dependencias futuras)
*   Servidor Web (Apache/Nginx)
*   MySQL 5.7+

### Paso a Paso

1.  **Clonar Repositorio**
    ```bash
    git clone https://github.com/tu-org/sigp.git
    cd sigp
    ```

2.  **Configurar Entorno**
    ```bash
    cp .env.example .env
    # Editar .env con tus credenciales de base de datos
    ```

3.  **Base de Datos**
    *   Crear base de datos vacía (ej. `sigp_db`).
    *   Ejecutar migraciones (Script personalizado):
    ```bash
    php migrations/migrate.php
    ```
    *(Nota: Si es una instalación limpia, importar primero `public/databases/setup_structure.sql` si existe, o usar los seeders)*.

4.  **Dependencias (Opcional)**
    ```bash
    composer install
    ```

5.  **Despliegue**
    *   Apuntar el DocumentRoot del servidor web a la carpeta raíz del proyecto.
    *   Asegurar permisos de escritura en `uploads/`.

---

## 🧪 Testing y Calidad

El proyecto incluye una suite de pruebas automatizadas ligera.

```bash
# Ejecutar pruebas de integración y unitarias
php tests/run_tests.php
```

---

## 📄 Estructura de Directorios

```
/app            # Núcleo de la aplicación (Controllers, Models, Views)
/config         # Configuraciones globales
/migrations     # Scripts de migración de base de datos versionados
/public         # Entry point (index.php) y assets estáticos (CSS/JS/Img)
/tests          # Suite de pruebas automatizadas
/uploads        # Almacenamiento de archivos de usuario
.env            # Variables de entorno (No versionado)
```

---

&copy; 2026 SIGP. Desarrollado con ❤️ y estándares de seguridad modernos.

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
