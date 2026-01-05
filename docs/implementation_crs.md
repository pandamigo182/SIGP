# Plan de Implementación: Formato ERS y Visualizador Final

## Objetivo
Estandarizar el entregable `reporte_proyecto.html` utilizando estrictamente la estructura de `ERS_SIGP.html` y asegurar que el `visualizador_bd.html` cumpla con los requisitos de exportación y layout.

## 1. Migración de Reporte (ERS)
Se tomará el código de `docs/ERS_SIGP.html` y se guardará como `docs/ADMINISTRACION/reporte_proyecto.html`.

### Cambios a realizar en la plantilla:
- **Portada**:
    - Verificar título alineado a la izquierda.
    - Franja azul lateral.
    - Sin logo en el centro.
- **Información del Proyecto**:
    - Confirmar integrantes del Grupo 23.
    - Fechas tentativas (Marzo 2026).
- **Requerimientos Funcionales (Tabla Estandarizada)**:
    - Agregar **RF-004: Evaluación de Pasantía** (Empresa califica).
    - Agregar **RF-005: Generación de Reportes** (Estudiante sube PDF).
    - Agregar **RF-006: Bitácora de Auditoría** (Seguridad).
- **Requerimientos No Funcionales**:
    - Desempeño (Carga < 2s).
    - Seguridad (Argon2, ISO 27001).
- **Cronograma**:
    - Actualizar estados a "Completado" (Fase 1, 2) y "En Progreso" (Fase 3).
    - Fechas tentativas para Fase 4.

## 2. Refinamiento Visualizador BD
- **Layout**: Mantener Card + Sidebar.
- **Simulación**:
    - Asegurar que la animación muestre "ramificación" (ej. al registrar, salen 2 partículas: una para `usuarios`, otra para `perfil`).
    - Explicación textual en panel lateral/inferior.
- **Exportación**:
    - Integrar `html2canvas` para botón "Guardar Imagen".
    - Botón "Imprimir" para PDF.

## 3. Verificación
- **Manual**: Abrir ambos archivos en navegador.
- **Visual**: Confirmar coincidencia con capturas de referencia.
