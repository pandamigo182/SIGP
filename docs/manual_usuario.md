# Manual de Usuario e Instalación - SIGP

> **Guía Oficial de Despliegue y Uso**
> **Proyecto:** Sistema Integral de Gestión de Pasantías
> **Versión:** 1.0 (Final)
> **Fecha:** Diciembre 2025

---

## Tabla de Contenidos
1.  [Introducción](#1-introducción)
2.  [Instalación](#2-instalación)
    *   [Requisitos](#requisitos-del-sistema-producción)
    *   [Seguridad](#garantías-de-seguridad)
    *   [Pasos](#pasos-de-instalación-local--dev)
3.  [Guía de Uso](#3-guía-de-uso)

---

## 1. Introducción
El Sistema Integral de Gestión de Pasantías (SIGP) facilita la conexión entre estudiantes y empresas para la realización de prácticas profesionales.

## 2. Instalación

### Requisitos del Sistema (Producción)
*   **Servidor Web**: Apache / Nginx / Azure App Service
*   **Lenguaje**: PHP 7.4 - 8.2 (Recomendado 8.2 para Argon2id nativo)
*   **Base de Datos**: MySQL 5.7+ / Azure Database for MySQL
*   **Extensiones**: `sodium` (para Argon2id), `pdo`, `mbstring`.

### Garantías de Seguridad
El sistema implementa medidas de protección avanzadas:
1.  **Protección de Datos**: Sus contraseñas son cifradas irreversiblemente.
2.  **Sesiones Seguras**: Cierre automático por inactividad y protección contra robo de sesión.
3.  **Auditoría**: Cada acción crítica queda registrada en la bitácora del sistema.

### Pasos de Instalación (Local / Dev)
1.  **Clonar Repositorio**: Descargue el código fuente en su servidor web.
2.  **Base de Datos**:
    *   Cree una base de datos llamada `sigp_db`.
    *   Importe el archivo `public/databases/sigp_complete.sql`.
3.  **Configuración**:
    *   Renombre `.env.example` a `.env`.
    *   Edite `.env` con las credenciales de su base de datos y correo SMTP.
4.  **Dependencias**:
    *   Ejecute `composer install` para descargar librerías de terceros.
5.  **Verificación**:
    *   Acceda a la URL de su servidor (ej. `http://localhost/SIGP`).

## 3. Guía de Uso

### Para Estudiantes
*   **Registro**: Cree una cuenta seleccionando el perfil de estudiante.
*   **Perfil Completo**: Complete su información académica, habilidades y suba su CV.
*   **Buscar Pasantías**: Navegue por las ofertas disponibles y aplique con un clic.
*   **Seguimiento**: Revise el estado de sus postulaciones en el dashboard.

### Para Empresas
*   **Publicar Ofertas**: Use el botón "Nueva Plaza" para detallar los requisitos.
*   **Gestionar Candidatos**: Revise los perfiles de los postulantes y cambie su estado a "Aceptado" o "Rechazado".
*   **Evaluaciones**: Al finalizar la pasantía, complete la evaluación de desempeño.

### Para Administradores
*   **Gestión de Usuarios**: Cree, edite o suspenda usuarios.
*   **Reportes**: Acceda al módulo de reportes para visualizar estadísticas de uso y exportar datos.
*   **Ajustes**: Configure parámetros generales del sistema.
