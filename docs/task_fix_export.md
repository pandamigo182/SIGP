# Tareas: Fix Export y Embed Logo

- [ ] **Lectura de Assets**
    - [x] Leer `logo-completo.svg` (para embed).

- [ ] **Estructura BD (`estructura_bd_sigp.html`)**
    - [ ] **Reescritura Completa**: Usar `write_to_file` para evitar errores de patching.
    - [ ] **Embed Logo**: Insertar el string SVG del logo en variable JS.
    - [ ] **Funciones Exportación**:
        - [ ] `exportSVG()`: Integrar logo SVG + Diagrama Mermaid en un solo archivo.
        - [ ] `printPDF()`: CSS `@media print` que oculta `.sidebar`, `.toolbar` y muestra `#header-print` con logo.
    - [ ] **Animación**: Asegurar que `simulateData` funcione y, si es posible, dejar un rastro visual si se exporta *durante* la simulación (opcional/difícil en SVG estático, pero intentaremos capturar el estado).
