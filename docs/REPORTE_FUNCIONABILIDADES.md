# Reporte de Funcionalidades - SIGP

Fecha: 22 de Diciembre de 2025
Versión del Sistema: 2.0.0

## 1. Módulo de Seguridad y Acceso
*   **Autenticación Robusta**: Login con encriptación de contraseñas (BCRYPT) y protección contra fuerza bruta básica.
*   **Control de Sesiones**: Manejo seguro de sesiones PHP con regeneración de ID para prevenir secuestros.
*   **Recuperación de Contraseña**: Flujo completo vía correo electrónico con tokens temporales de un solo uso.
*   **Roles y Permisos**: Sistema RBAC con 5 niveles (Admin, Coordinador, Tutor, Empresa, Estudiante).

## 2. Módulo de Estudiantes
*   **Perfil Profesional**: Edición completa de datos personales, académicos y ubicación.
*   **CV Digital**: Carga y visualización de Curriculum Vitae en formatos PDF/Imagen.
*   **Gestión de Habilidades**: Selección múltiple de competencias técnicas y blandas.
*   **Experiencia y Certificaciones**: CRUD (Crear, Leer, Actualizar, Borrar) para historial laboral y diplomas obtenidos.
*   **Postulación**: Búsqueda y aplicación a plazas disponibles con seguimiento de estado.

## 3. Módulo de Empresas
*   **Gestión de Ofertas**: Publicación, edición y cierre de vacantes de pasantía.
*   **Selección de Talento**: Visualización de candidatos postulados con opciones para Aceptar o Rechazar.
*   **Evaluaciones**: Herramienta para calificar el desempeño de los pasantes al finalizar el periodo.

## 4. Módulo Administrativo y Reportería
*   **Gestión de Usuarios**: Panel centralizado para administrar todas las cuentas del sistema.
*   **Analíticas Visuales**:
    *   **Mapa Interactivo**: Distribución de estudiantes por departamento en El Salvador.
    *   **Gráficos**: Distribución por género y rubros empresariales.
*   **Exportación de Datos**: Capacidad de generar reportes ejecutivos en PDF y Excel directamente desde el navegador.

## 5. Arquitectura Técnica
*   **Base de Datos**: Relacional (MySQL) optimizada con índices y claves foráneas.
*   **Frontend**: Diseño responsivo (Bootstrap 5) adaptable a móviles y escritorio.
*   **Backend**: Estructura MVC escalable, preparada para migración a Laravel (V2.0).
