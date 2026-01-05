# Guía de Pruebas y Normativa de Calidad - SIGP

## 1. Recomendaciones de Normativa ISO

El sistema SIGP ya cumple con partes críticas de ISO 27001 (Seguridad). Para llevar la calidad al nivel empresarial, recomendamos adoptar las siguientes normas complementarias:

### ISO 9001:2015 (Gestión de Calidad)
*   **Enfoque**: Satisfacción del cliente (Estudiantes y Empresas).
*   **Aplicación en SIGP**: Implementar encuestas de satisfacción automáticas al finalizar cada pasantía (ya tenemos el módulo de Evaluación, se puede extender).

### ISO 22301 (Continuidad de Negocio)
*   **Enfoque**: Qué hacer si el sistema falla.
*   **Aplicación**: Establecer un plan de recuperación ante desastres (Disaster Recovery Plan).
    *   *Ejemplo*: Si Azure falla, tener una réplica de la base de datos lista para restaurar en otro servidor en menos de 4 horas.

---

## 2. Herramientas y Casos de Prueba ("Machotes")

A continuación se presentan plantillas (machotes) para realizar pruebas formales antes de cada lanzamiento.

### A. Plantilla de Prueba de Instalación

**Objetivo**: Verificar que el sistema se despliega correctamente en un servidor nuevo.

| ID | Paso | Resultado Esperado | Pasa/Falla | Observaciones |
|:---|:---|:---|:---|:---|
| INST-01 | Clonar repositorio Git | Carpeta `SIGP` creada con archivos. | [ ] | |
| INST-02 | Importar Base de Datos (`sigp_complete.sql`) | Tablas creadas sin errores SQL. | [ ] | |
| INST-03 | Configurar `.env` | Conexión a DB establecida. | [ ] | |
| INST-04 | Cargar Login (`/auth/login`) | Formulario visible, sin errores PHP. | [ ] | |
| INST-05 | Registro Nuevo Usuario | Usuario creado en DB y redirigido a Dashboard. | [ ] | |

### B. Plantilla de Pruebas de Aceptación de Usuario (UAT)

**Objetivo**: Validar flujos de negocio críticos.

**Actor: Estudiante**
| ID | Escenario | Resultado Esperado | Pasa/Falla |
|:---|:---|:---|:---|
| UAT-EST-01 | Editar Perfil | Cambios guardados y visibles al recargar. | [ ] |
| UAT-EST-02 | Aplicar a Plaza | Mensaje "Postulación Exitosa", estado "Pendiente". | [ ] |
| UAT-EST-03 | Subir Reporte | Archivo PDF subido, aparece en lista de reportes. | [ ] |

**Actor: Empresa**
| ID | Escenario | Resultado Esperado | Pasa/Falla |
|:---|:---|:---|:---|
| UAT-EMP-01 | Crear Plaza | Plaza visible en listado público. | [ ] |
| UAT-EMP-02 | Aceptar Postulante | Estado cambia a "Aceptada", estudiante notificado. | [ ] |

### C. Plantilla de Reporte de Bugs

Utilizar este formato cuando se encuentre un error:

*   **Título**: [Corto y descriptivo, ej. Error 500 al subir foto de perfil]
*   **Severidad**: Crítica / Alta / Media / Baja
*   **Pasos para Reproducir**:
    1.  Ir a Perfil.
    2.  Clic en "Subir Foto".
    3.  Seleccionar archivo `foto.jpg`.
*   **Comportamiento Esperado**: La foto se actualiza.
*   **Comportamiento Actual**: Pantalla blanca o mensaje de error.
*   **Evidencia**: (Adjuntar captura de pantalla).

---

## 3. Próximos Pasos Sugeridos
1.  **Automatizar Pruebas**: Crear scripts que llenen estas plantillas automáticamente (usando herramientas como Selenium o Cypress).
2.  **Auditoría Trimestral**: Revisar logs de seguridad cada 3 meses para buscar patrones sospechosos.
