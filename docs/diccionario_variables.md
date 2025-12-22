# Diccionario de Variables - SIGP

## 1. Tabla: `usuarios`
Almacena la información de acceso y básica de todos los actores del sistema.

| Columna | Tipo | Descripción | Restricciones |
| :--- | :--- | :--- | :--- |
| `id` | INT(11) | Identificador único del usuario. | PK, Auto Increment |
| `nombre` | VARCHAR(100) | Nombre completo del usuario. | Not Null |
| `email` | VARCHAR(100) | Correo electrónico para acceso. | Unique, Not Null |
| `password` | VARCHAR(255) | Hash de la contraseña. | Not Null |
| `role_id` | INT(11) | Rol del usuario (1=Admin, 3=Estudiante, 5=Empresa). | FK -> `roles` |
| `created_at` | DATETIME | Fecha de registro. | Default CURRENT_TIMESTAMP |

## 2. Tabla: `estudiantes` (o `perfil_estudiantes`)
Información extendida para usuarios con rol de estudiante.

| Columna | Tipo | Descripción | Restricciones |
| :--- | :--- | :--- | :--- |
| `user_id` | INT(11) | Referencia al usuario. | FK -> `usuarios`, Unique |
| `dui` | VARCHAR(20) | Documento Único de Identidad. | Unique |
| `telefono` | VARCHAR(15) | Teléfono de contacto. | Nullable |
| `departamento` | VARCHAR(50) | Departamento de residencia. | Nullable |
| `genero` | ENUM | Género del estudiante (Masculino, Femenino, Otro). | Nullable |
| `carrera_id` | INT(11) | Carrera que cursa. | FK -> `carreras` |

## 3. Tabla: `empresas`
Perfil corporativo.

| Columna | Tipo | Descripción | Restricciones |
| :--- | :--- | :--- | :--- |
| `id` | INT(11) | Identificador de la empresa. | PK, Auto Increment |
| `nombre_comercial` | VARCHAR(100) | Nombre público de la empresa. | Not Null |
| `rubro` | VARCHAR(100) | Sector industrial (Tecnología, Salud, etc.). | Nullable |
| `user_id` | INT(11) | Usuario administrador de la cuenta empresa. | FK -> `usuarios` |

## 4. Tabla: `plazas`
Oportunidades de pasantía publicadas.

| Columna | Tipo | Descripción | Restricciones |
| :--- | :--- | :--- | :--- |
| `id` | INT(11) | Identificador de la vacante. | PK, Auto Increment |
| `titulo` | VARCHAR(150) | Título de la plaza. | Not Null |
| `descripcion` | TEXT | Detalle de actividades y requisitos. | Not Null |
| `empresa_id` | INT(11) | Empresa ofertante. | FK -> `empresas` |
| `estado` | ENUM | Estado (abierta, cerrada, pausada). | Default 'abierta' |


*Nota: Este diccionario se mantiene actualizado conforme evoluciona la estructura de base de datos.*
