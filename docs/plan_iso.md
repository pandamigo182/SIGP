# Plan de Implementación: ISO 9001 y Estandarización Documental

## Objetivo
Cumplir con la solicitud del usuario de implementar recomendaciones ISO (Encuestas de Satisfacción) y generar herramientas de prueba exhaustivas (Plan Maestro de Pruebas), estandarizando toda la documentación al formato profesional existente.

## User Review Required
> [!IMPORTANT]
> Se crearán nuevos archivos MVC para las encuestas. Se requiere aprobación para modificar la Base de Datos (`sigp_db`) agregando la tabla `encuestas_satisfaccion`.

## Proposed Changes

### 1. Base de Datos (ISO 9001)
#### [NEW] [encuestas_iso.sql](file:///c:/xampp/htdocs/SIGP/public/databases/encuestas_iso.sql)
- Script para crear tabla `encuestas_satisfaccion`.

### 2. Backend (MVC)
#### [NEW] [Encuesta.php](file:///c:/xampp/htdocs/SIGP/app/models/Encuesta.php)
- Modelo para guardar respuestas.
#### [NEW] [Encuestas.php](file:///c:/xampp/htdocs/SIGP/app/controllers/Encuestas.php)
- Controlador para manejar la vista y el envío de datos.

### 3. Frontend
#### [NEW] [encuesta.php](file:///c:/xampp/htdocs/SIGP/app/views/encuestas/encuesta.php)
- Formulario de satisfacción sencillo (Estrellas 1-5).
#### [MODIFY] [footer.php](file:///c:/xampp/htdocs/SIGP/app/views/layouts/footer.php)
- Agregar enlace "Danos tu opinión" para acceso fácil.

### 4. Documentación Estandarizada
Actualizar y crear los siguientes documentos con **Portada, Tabla de Contenidos, Encabezados y Formato Profesional**:
- `docs/PLAN_MAESTRO_PRUEBAS.md` (Nuevo: Machotes exhaustivos).
- `docs/vision_general.md` (Update).
- `docs/manual_usuario.md` (Update).
- `docs/propuesta_v2.md` (Update).
- `docs/ESQUEMA_BASE_DATOS.md` (Update).

## Verification Plan

### Automated Tests
- Ejecutar SQL manual o vía script PHP test para verificar creación de tabla.
- `browser_tool` para navegar a `/encuestas` y enviar un formulario de prueba.

### Manual Verification
1.  **Encuestas**: Ingresar como Estudiante -> Clic en "Danos tu opinión" -> Llenar -> Verificar registro en BD.
2.  **Documentación**: Revisar visualmente los archivos `.md` generados.
