# Plan de Optimización de Visualizador BD

## Problemas Detectados
1. **Tamaño Excesivo**: El diagrama generado por Mermaid es demasiado grande (zoom 100% por defecto), ocupando más de la pantalla y saliéndose de la hoja al imprimir.
2. **Simulaciones Incompletas**: Solo existen 2 simulaciones actualmente. Se requiere cubrir todos los módulos.
3. **Faltan Relaciones**: La tabla `usuario_habilidades` y otras conexiones intermedias faltan en la definición JS, lo que afectará las simulaciones.

## Solución Propuesta

### 1. Ajuste Visual (Size & Print)
*   **Web**: Forzar que el SVG generado tenga `max-width: 95%` y `height: auto`. Centrarlo en el contenedor.
*   **Mermaid Config**: Usar `securityLevel: 'loose'`, `startOnLoad: false`, y ajustar parámetros de renderizado si es posible, pero principalmente controlar via CSS.
*   **Print**: En `@media print`, forzar el zoom o escala del SVG para asegurar que quepa en una página Letter/A4 Landscape.
    ```css
    @media print {
        svg {
            max-width: 270mm; /* A4 width approx */
            max-height: 180mm;
            width: auto !important;
            height: auto !important;
        }
    }
    ```

### 2. Actualización del Esquema (Data Definitions)
Agregar tablas faltantes para completar las simulaciones:
*   `usuario_habilidades`
*   Revisar uniones de `notificaciones` (si aplica).

### 3. Nuevas Simulaciones
Implementar lógica `simulate(type)` para:

| Módulo | Acción | Flujo Animado |
| :--- | :--- | :--- |
| **Auth** | Login | `CLIENT` -> `usuarios` -> `roles` |
| **Estudiantes** | Actualizar Perfil | `CLIENT` -> `perfil_estudiantes` -> `habilidades` |
| **Empresas** | Publicar Plaza | `CLIENT` -> `empresas` -> `plazas` |
| **Empresas** | Ver Postulantes | `CLIENT` -> `plazas` -> `postulaciones` -> `usuarios` |
| **Pasantías** | Crear Acuerdo | `CLIENT` -> `pasantias` (involucra `est` y `emp`) |
| **Pasantías** | Reporte Mensual | `CLIENT` -> `pasantias` -> `reportes` |
| **Pasantías** | Evaluación Final | `CLIENT` -> `pasantias` -> `evaluaciones` |
| **Geografía** | Consulta | `CLIENT` -> `departamentos` -> `municipios` -> `distritos` |

## Archivos a Modificar
*   `docs/estructura_bd_sigp.html`
