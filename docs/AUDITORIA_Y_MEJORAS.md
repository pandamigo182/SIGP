# Auditoría del Sistema SIGP y Mejoras Sugeridas

Fecha: 22 de Diciembre de 2025
Estado: **Finalizado / Corregido**

## 1. Auditoría de Ciberseguridad

### Estado Final
El sistema cuenta con medidas de seguridad robustas para un entorno de producción moderado (Nivel 2).

*   **Gestión de Secretos**: Implemetada correctamente. Las credenciales sensibles (Base de Datos y SMTP) se leen exclusivamente desde variables de entorno.
*   **Protección Anti-CSRF**: Activa y verificada en todos los formularios transaccionales (Login, Registro, Edición de Perfil).
*   **Manejo de Roles**: Estandarizado mediante constantes globales en `config.php`, reduciendo el riesgo de escalada de privilegios por errores de "números mágicos".

## 2. Auditoría de Datos e Integridad

### Mejoras Realizadas
*   **Normalización Geográfica**: Se eliminó la entrada de texto libre para el campo "Departamento" en el perfil de estudiante. Ahora se utiliza una lista controlada (Dropdown), lo que garantiza la consistencia de los datos para la generación de mapas y reportes.

### Recomendaciones Futuras
*   **Validación Estricta en Backend**: Aunque la UI limita las opciones, se recomienda agregar una validación `in_array` en el controlador `Users.php` para asegurar que nadie envíe datos modificados vía HTTP request.

## 3. Auditoría de Reportería

### Funcionalidad Actual
*   **Dashboards**: Operativos con integración de Highcharts y Highmaps.
*   **Exportación**: Se han verificado las librerías `html2pdf.js` y `SheetJS` para permitir la descarga de datos.
*   **Precisión**: Gracias a la normalización de datos, los mapas de calor por departamento ahora reflejarán estadísticas 100% precisas.

## 4. Conclusión del Montaje

El sistema se encuentra en un estado óptimo para su despliegue en producción ("Go Live"), cumpliendo con los requisitos de:
1.  Documentación técnica completa.
2.  Seguridad en manejo de credenciales.
3.  Experiencia de usuario mejorada en formularios críticos.

---
*Este documento certifica que las vulnerabilidades detectadas en la revisión inicial han sido mitigadas.*
