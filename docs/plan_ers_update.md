# Plan de Actualización ERS Final

## Objetivo
Generar `docs/ERS_final_sigp.html` fusionando el estilo visual A4 ya aprobado con el contenido específico de texto de `docs/ERS_SIGP.html` (Secciones 4 y 5), actualizando metadatos del equipo y cronograma.

## Cambios Específicos

### 1. Estructura y Estilo (A4 Paper)
*   Mantener clases `.page`, `.page-cover`, `.page-content` con sombras y media query `@print`.
*   **Margenes Impresión**: Ajustar `@page { margin: 15mm 0; }` y `body { padding: 0; }` en print para evitar que el navegador agregue encabezados/pies de página que rompan el diseño, pero permitir que el CSS controle los márgenes internos de la "hoja".

### 2. Contenido de `ERS_SIGP.html`
*   **Sección 4 (RF)**: Reemplazar las "Cards" actuales por **Tablas Estilizadas** que contengan exactamente los campos: ID, Versión, Precondición, Descripción, Secuencia, Postcondición y Excepciones (donde aplique) de RF-001 (Auth), RF-002 (Ofertas), RF-003 (Postulaciones).
*   **Sección 5 (RNF)**: Reemplazar lista actual con las 4 categorías exactas de `ERS_SIGP.html`: 
    1. Desempeño
    2. Usabilidad
    3. Confiabilidad
    4. Seguridad

### 3. Ajustes Administrativos
*   **Equipo**: Eliminar "Full Stack JR" de Edwin Juárez.
*   **Historial**: 
    *   3 filas vacías para futuro.
    *   Última entrada: Fecha "15/12/2025", Autor "Miguel Iraheta", Desc: "Versión inicial fase diseño".
*   **Cronograma**: Dejar la estructura de tabla pero con datos genéricos/"Pendiente" según instrucción "no está listo".
*   **Gráficos Finales**: Mantener el Isógrafo y Tabla Comparativa Azul, pero asegurar que el texto sea relevante ("Qué hace el sistema" vs "Cómo debe ser").

## Verificación
*   Abrir archivo en navegador.
*   "Imprimir a PDF" para verificar saltos de página y márgenes con el membretado.
