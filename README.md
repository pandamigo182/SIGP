# Sistema Integral de Gestión de Pasantías (SIGP)

![Banner SIGP](public/img/logo-completo.svg)

![Version](https://img.shields.io/badge/versión-2.0.0-blue.svg?style=flat-square)
![PHP](https://img.shields.io/badge/PHP-%5E7.4%20%7C%7C%20%5E8.0-777bb4.svg?style=flat-square&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479a1.svg?style=flat-square&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952b3.svg?style=flat-square&logo=bootstrap&logoColor=white)

> **Plataforma Enterprise** para la orquestación del ciclo de vida de prácticas profesionales. Diseñada con enfoque en seguridad, escalabilidad y experiencia de usuario.

---

## 🚀 Características Principales

### 👨‍🎓 Módulo de Estudiantes
*   **Perfil Profesional 360°**: Gestión de Curriculum Vitae, habilidades técnicas y blandas.
*   **Búsqueda Inteligente**: Filtrado de ofertas por geolocalización, modalidad (Remoto/Híbrido) y área profesional.
*   **Workflow de Pasantía**: Seguimiento en tiempo real desde la postulación hasta la certificación.
*   **Certificación Automatizada**: Generación de constancias PDF con firma digital al completar exitosamente.

### 🏢 Módulo de Empresas
*   **Publicación de Vacantes**: Asistente para creación de plazas con perfiles detallados.
*   **Gestión de Talento**: ATS (Sistema de Seguimiento de Candidatos) ligero para evaluar postulantes.
*   **Evaluación de Desempeño**: Herramientas integradas para realizar evaluaciones de medio y final de término.

### 🛡️ Módulo Administrativo
*   **Gestión RBAC**: Control de acceso basado en roles granular (Admin, Empresa, Estudiante, Tutor).
*   **Auditoría & Logs**: Trazabilidad completa de acciones críticas del sistema (Bitácora).
*   **Reportería Avanzada**: Dashboards con métricas de género, ubicación geográfica y rubros.
*   **Motor de Plantillas**: Editor de diplomas y certificados dinámicos.

---

## 🛠️ Stack Tecnológico

*   **Backend**: PHP 8 (Arquitectura MVC Custom).
*   **Frontend**: Bootstrap 5, CSS Variables, Vanilla JS (ES6+).
*   **Base de Datos**: MySQL / MariaDB con diseño relacional estricto.
*   **Seguridad**:
    *   Sanitización de I/O (Input/Output).
    *   Protección CSRF Global en formularios.
    *   Sentencias Preparadas (PDO) anti-SQL Injection.
    *   Gestión de secretos vía variables de entorno (`.env`).

---

## ⚙️ Guía de Instalación y Montaje

### Requisitos Previos
*   **Servidor Web**: Apache (XAMPP/WAMP recomendado).
*   **PHP**: Versión 7.4 o superior (Compatible con 8.1+).
*   **Base de Datos**: MySQL 5.7+ / MariaDB.
*   **Composer**: Para instalar dependencias (PHPMailer).

### Paso a Paso

1.  **Despliegue de Código**
    *   Clonar el proyecto en la carpeta pública del servidor (ej: `C:\xampp\htdocs\SIGP`).
    ```bash
    git clone https://github.com/pandamigo182/sigp.git
    ```

2.  **Instalar Dependencias**
    *   Ejecutar Composer para instalar librerías necesarias como PHPMailer.
    ```bash
    composer install
    ```

3.  **Configuración de Entorno (.env)**
    *   Copiar el archivo de ejemplo.
    ```bash
    cp .env.example .env
    ```
    *   **IMPORTANTE**: Editar el archivo `.env` y configurar:
        *   Credenciales de Base de Datos (`DB_USER`, `DB_PASS`).
        *   Credenciales SMTP para correos (`SMTP_USER`, `SMTP_PASS`). *Se recomienda usar Contraseñas de Aplicación de Google.*

4.  **Base de Datos**
    *   Crear una base de datos vacía (ej. `sigp_db`).
    *   Importar la estructura y datos iniciales:
        *   Opción A (Completa): Importar `public/databases/sigp_complete.sql`.
        *   Opción B (Migrations): Ejecutar `php migrations/migrate.php` y luego los seeders.

5.  **Verificación**
    *   Acceder a `http://localhost/SIGP`.
    *   Credenciales Admin por defecto (si se usaron seeders):
        *   Usuario: `admin@sigp.com`
        *   Contraseña: `admin123`

---

## 🧪 Auditoría y Calidad

El sistema ha sido auditado recientemente (Diciembre 2025) cubriendo:
*   **Ciberseguridad**: Verificación de CSRF, Hashing y manejo de sesiones.
*   **Datos**: Integridad y normalización.
*   **Reportería**: Cobertura de métricas clave.

Para ver el reporte completo de auditoría y mejoras sugeridas, consultar: [docs/AUDITORIA_Y_MEJORAS.md](docs/AUDITORIA_Y_MEJORAS.md).

---

## 🔒 Seguridad Implementada
*   **Sanitización de Entradas**: Uso de `filter_input` para prevenir XSS.
*   **Sentencias Preparadas**: PDO para evitar Inyecciones SQL.
*   **Control de Acceso (RBAC)**: Middleware de verificación de roles por controlador.
*   **Validación de Archivos**: Restricciones de tipo y ubicación para subidas.

---

&copy; 2026 SIGP. Desarrollado con ❤️ y estándares de seguridad modernos.
