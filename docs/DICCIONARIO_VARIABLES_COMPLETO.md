# Diccionario de Variables y Base de Datos - SIGP

> **Documento Técnico de Referencia**
> **Versión:** 1.0 Final
> **Proyecto:** Sistema Integral de Gestión de Pasantías

Este documento detalla todas las variables (campos) almacenadas en la base de datos `sigp_db`, explicando su tipo y propósito para facilitar el mantenimiento por parte de futuros desarrolladores (Bachillerato/TSU).

---

## 1. Tabla: `usuarios` (La Maestra)
Almacena las credenciales de acceso de todos los actores.

| Variable (Campo) | Tipo Datos | Descripción |
| :--- | :--- | :--- |
| `id` | INT (PK) | Número único de identificación del usuario. |
| `role_id` | INT (FK) | Conecta con tabla `roles`. (1=Admin, 2=Empresa, 5=Estudiante). |
| `nombre` | VARCHAR | Nombre completo visualizar en Dashboard. |
| `email` | VARCHAR | Correo electrónico usado para Login. Único en el sistema. |
| `password` | VARCHAR | Contraseña encriptada con algoritmo Argon2id. |
| `estado` | ENUM | 'activo' (puede entrar) o 'inactivo' (bloqueado). |
| `created_at` | DATETIME | Fecha y hora de creación de la cuenta. |

## 2. Tabla: `perfil_estudiantes`
Detalles académicos del alumno.

| Variable (Campo) | Tipo Datos | Descripción |
| :--- | :--- | :--- |
| `id` | INT (PK) | Identificador del perfil. |
| `usuario_id` | INT (FK) | Enlace al usuario dueño de este perfil. |
| `carrera` | VARCHAR | Nombre de la carrera técnica o ingeniería. |
| `matricula` | VARCHAR | Código de carnet estudiantil. |
| `telefono` | VARCHAR | Número de contacto. |
| `cv_path` | VARCHAR | Ruta del archivo PDF del Currículum en el servidor. |

## 3. Tabla: `perfil_empresas`
Información pública de las empresas ofertantes.

| Variable (Campo) | Tipo Datos | Descripción |
| :--- | :--- | :--- |
| `id` | INT (PK) | Identificador del perfil empresarial. |
| `usuario_id` | INT (FK) | Enlace a la cuenta de usuario de la empresa. |
| `nombre_comercial` | VARCHAR | Nombre conocido por el público (Marca). |
| `razon_social` | VARCHAR | Nombre legal jurídico. |
| `rubro` | VARCHAR | Sector económico (Ej. Tecnología, Textil). |

## 4. Tabla: `plazas` (Ofertas)
Las vacantes disponibles para pasantía.

| Variable (Campo) | Tipo Datos | Descripción |
| :--- | :--- | :--- |
| `id` | INT (PK) | Identificador de la vacante. |
| `empresa_id` | INT (FK) | Quién publica la oferta. |
| `titulo` | VARCHAR | Título del puesto (Ej. Desarrollador Web). |
| `descripcion` | TEXT | Detalles de actividades y requisitos. |
| `estado` | ENUM | 'abierta' (visible), 'cerrada' (nadie aplica). |

## 5. Tabla: `postulaciones`
Registro de aplicaciones de estudiantes a plazas.

| Variable (Campo) | Tipo Datos | Descripción |
| :--- | :--- | :--- |
| `id` | INT (PK) | Identificador de la aplicación. |
| `plaza_id` | INT (FK) | A qué plaza aplica. |
| `estudiante_id` | INT (FK) | Quién aplica. |
| `estado` | ENUM | 'pendiente', 'aceptada', 'rechazada'. |
| `fecha_postulacion`| DATETIME | Cuándo aplicó. |

## 6. Variables Globales de Sesión (PHP)
Variables temporales vivas mientras el usuario navega.

| Variable `$_SESSION` | Descripción |
| :--- | :--- |
| `user_id` | ID del usuario logueado actualmente. |
| `user_email` | Correo del usuario actual. |
| `user_role` | Número de rol (Permite ocultar/mostrar menús). |
| `user_name` | Nombre para mostrar en el saludo. |

---
**Glosario Técnico:**
*   **PK (Primary Key):** Llave Primaria. Es el DUI del registro. No se repite.
*   **FK (Foreign Key):** Llave Foránea. Es un enlace a otra tabla.
*   **NULL:** Indica que el campo puede quedarse vacío.
*   **VARCHAR:** Texto corto (hasta 255 letras).
*   **TEXT:** Texto largo (párrafos completos).
