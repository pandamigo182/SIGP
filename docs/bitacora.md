# Bitácora de Actividades y Hallazgos - SIGP

## Historial de Cambios (Diciembre 2025)

| Commit ID | Autor | Fecha | Descripción |
|-----------|-------|-------|-------------|
| - | Edwin Juárez | 2025-12-23 | **Seguridad Mayor**: Migración de hashing a **Argon2id**. |
| - | Edwin Juárez | 2025-12-23 | **Cumplimiento ISO**: Creación de documentación y auditoría automatizada (`security_audit.php`). |
| - | Edwin Juárez | 2025-12-23 | **Observabilidad**: Implementación de Logging Global de Errores Fatales visible para Admin. |
| - | Edwin Juárez | 2025-12-22 | Creación de Guía de Despliegue Azure for Students. |
| - | Edwin Juárez | 2025-12-22 | Ejecución de Protocolo Leviatán Completo y Pruebas Omega. |

## Registro de Pruebas y Hallazgos

### Fase 4: Blindaje de Seguridad (ISO)
| Control ISO | Implementación | Resultado | Detalles |
|-------------|----------------|-----------|----------|
| A.9.4.3 | Hashing Argon2id | **Implementado** | Resistente a GPU/ASIC. Incluye re-hashing automático. |
| A.12.4.1 | Logging Global | **Implementado** | Errores fatales (500) se guardan en BD y son visibles para el Admin. |
| Audit | Script de Auditoría | **Ejecutado** | Verifica permisos, headers y seguridad de contraseñas. |

### Fase 3: Pruebas de Calidad (QA) y Seguridad (Leviatán)
| Categoría | Prueba | Resultado | Detalles |
|-----------|--------|-----------|----------|
| Estrés | Omega Protocol (Carga) | **PASA** | ~3000 req/min sostenidos s/errores. SMTP verificado. |
| Seguridad | Fuzzing (Login) | **PASA** | Payloads maliciosos manejados correctamente. |
