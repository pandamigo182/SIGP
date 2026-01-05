# Plan de Optimización y Documentación Técnica

## Objetivo
1.  Retirar el tutorial interactivo (Intro.js) por problemas de carga.
2.  Generar documentación exhaustiva de la Base de Datos (Esquema + Explicación).
3.  Proveer guías de pruebas y normativas adicionales (Templates).

## Cambios Propuestos

### 1. UX / Frontend
#### [MODIFY] [header.php](file:///c:/xampp/htdocs/SIGP/app/views/layouts/header.php)
- Eliminar referencia CSS a Intro.js.
#### [MODIFY] [footer.php](file:///c:/xampp/htdocs/SIGP/app/views/layouts/footer.php)
- Eliminar referencia JS e inicialización de Intro.js.

### 2. Documentación
#### [NEW] [ESQUEMA_BASE_DATOS.md](file:///c:/xampp/htdocs/SIGP/docs/ESQUEMA_BASE_DATOS.md)
- Diagrama ER (Mermaid).
- Diccionario de Datos (Explicación FK/PK nivel bachillerato).

#### [NEW] [GUIA_PRUEBAS_ISO.md](file:///c:/xampp/htdocs/SIGP/docs/GUIA_PRUEBAS_ISO.md)
- Recomendaciones Normas ISO (9001, 22301).
- Plantillas de Pruebas "Machotes" (Instalación, UAT).

## Plan de Verificación
### Manual Verification
1.  **UI Check**: Cargar Dashboard/Home y verificar que no hay errores de consola relacionados con Intro.js y que la UX es limpia.
2.  **Doc Review**: Verificar que los archivos Markdown se renderizan correctamente (Diagramas Mermaid).
