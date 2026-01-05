# Tareas: Animación y Exportación Limpia (`estructura_bd_sigp.html`)

- [ ] **Exportación Limpia**
    - [ ] **PDF**: Configurar `@media print` para ocultar Sidebar, Botones y Toolbar.
    - [ ] **Encabezado**: Agregar div `#export-header` con Logo y Título, visible solo en print/export.
    - [ ] **SVG**: Modificar función para clonar el SVG y añadirle el encabezado (Embed Logo) antes de descargar.

- [ ] **Animaciones de Flujo**
    - [ ] Implementar `simulateFlow(scenario)`:
        - [ ] "Registration": Frontend -> `usuarios` -> `perfil_estudiantes`.
        - [ ] "Job Post": Frontend -> `plazas`.
    - [ ] Lógica:
        - [ ] Ubicar coordenadas de nodos SVG (`#cell-usuarios`, etc).
        - [ ] Animar elemento `.data-packet` desde origen a destino.
        - [ ] Efecto visual de "escritura" en nodo destino.

- [ ] **Refinamiento UI**
    - [ ] Agregar botones de simulación en el toolbar principal cuando se ve el diagrama completo o relevante.
