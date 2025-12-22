# Manual de Usuario e Instalación - SIGP

## 1. Introducción
El Sistema Integral de Gestión de Pasantías (SIGP) facilita la conexión entre estudiantes y empresas para la realización de prácticas profesionales.

## 2. Instalación

### Requisitos del Sistema
*   **Servidor Web**: Apache / Nginx
*   **Lenguaje**: PHP 7.4+
*   **Base de Datos**: MySQL 5.7+ / MariaDB
*   **Gestor de Dependencias**: Composer

### Pasos de Instalación
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
