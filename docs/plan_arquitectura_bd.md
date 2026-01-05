# Plan de Implementación: Arquitectura de Base de Datos Interactiva

## Objetivo
Crear `docs/estructura_bd_sigp.html`, una herramienta "Single Page Application" (SPA) estática que renderice el diagrama Entidad-Relación (ER) del sistema SIGP usando Mermaid.js, con capacidades de filtrado por módulos y exportación.

## 1. Diseño Técnico
- **Framework UI**: Bootstrap 5 (CDN) con tema institucional (Azul `#0d6efd` / `#003366`).
- **Motor Gráfico**: Mermaid.js 10.x (CDN).
- **Lógica de Filtrado**:
    - Se definirá el diagrama completo en una variable string de JS.
    - Al hacer clic en un módulo (ej. "Estudiantes"), se regenerará el diagrama inyectando clases CSS (`class tabla users_table highlight;`) o, más robusto, filtrando las líneas del diagrama para mostrar solo los nodos relevantes y sus relaciones directas. *Decisión: Filtrado real para limpiar la vista.*
- **Exportación**:
    - `html2canvas` + `jspdf` para generar archivos descargables.

## 2. Definición del Esquema (Mapping SQL -> Mermaid)
Se extraerán las siguientes tablas del `sigp_complete.sql`:
- **Auth**: `usuarios`, `roles`.
- **Estudiantes**: `perfil_estudiantes`, `carreras`, `habilidades`, `experiencia_laboral`.
- **Empresas**: `empresas`, `perfil_empresas`, `plazas`, `postulaciones`.
- **Pasantías**: `pasantias`, `reportes`, `evaluaciones`.
- **Geo**: `departamentos`, `municipios`.

## 3. Pasos de Ejecución
1. Crear archivo `docs/estructura_bd_sigp.html`.
2. Implementar estructura HTML/Bootstrap con Sidebar fija y Main Canvas.
3. Escribir script JS que contenga la definición `erDiagram` completa.
4. Implementar funciones `filterGraph(module)` que reconstruyan el string Mermaid segun el set de tablas predefinido para cada módulo.
5. Agregar botones de exportación.

## Verificación
- Abrir archivo en navegador.
- Probar cada botón de módulo -> El diagrama debe redibujarse solo con las tablas del grupo.
- Probar exportación PDF -> Debe descargar archivo legible.
