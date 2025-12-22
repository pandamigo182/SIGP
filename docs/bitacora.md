# Bitácora de Actividades y Hallazgos - SIGP

## Historial de Cambios (Diciembre 2025)

| Commit ID | Autor | Fecha | Descripción |
|-----------|-------|-------|-------------|
| - | Edwin Juárez | 2025-12-22 | Creación de Guía de Despliegue Azure for Students. |
| - | Edwin Juárez | 2025-12-22 | Creación de Guía de Despliegue y Script de Optimización SQL. |
| - | Edwin Juárez | 2025-12-22 | Implementación de Lazy Loading en Vistas. |
| - | Edwin Juárez | 2025-12-22 | Implementación de Tutorial Interactivo (Intro.js) y Marcar Leídas. |
| - | Edwin Juárez | 2025-12-22 | Ejecución de Protocolo Leviatán Completo (Fuzzing + Soporte 1k msgs). |
| - | Edwin Juárez | 2025-12-22 | Ejecución de Pruebas de estrés básicas y QA de Responsividad. |

## Registro de Pruebas y Hallazgos

### Fase 1: Inicialización
| Fecha/Hora | Actividad | Estado | Hallazgos/Notas |
|------------|-----------|--------|-----------------|
| 2025-12-22 | Auditoría | Completado | Se detectaron credenciales SMTP hardcodeadas. Corregido. |
| 2025-12-22 | Refactor config | Completado | Se definieron constantes globales para los roles. |

### Fase 2: Optimización y Despliegue
| Categoría | Acción | Resultado | Detalles |
|-----------|--------|-----------|----------|
| DevOps | Guía Azure | Documentado | `DEPLOY_AZURE.md` creado como alternativa sin tarjeta de crédito. |
| Backend | SQL Indexes | Script Creado | `optimization_indexes.sql` listo para importar. Acelera queries críticas. |
| Frontend | Lazy Loading | Implementado | Se agregó `loading="lazy"` en avatares y logos de empresas para mejorar First Contentful Paint. |
| DevOps | Guía Digital Ocean | Documentado | `DEPLOY_DIGITAL_OCEAN.md` detalla pasos para Ubuntu 22.04 + LAMP. |

### Fase 3: Pruebas de Calidad (QA) y Seguridad (Leviatán)
| Categoría | Prueba | Resultado | Detalles |
|-----------|--------|-----------|----------|
| Estrés | Carga Extrema (20k Users) | **ALERTA** | Latencia alta (>100s). Se requiere Cache/Redis urgentemente. |
| Seguridad | Ataque DoS (Flood) | **PASA** | Servidor resiste sin caída total, aunque lento. |
| Seguridad | Fuzzing (Login) | **PASA** | Payloads maliciosos manejados correctamente. |
| Funcional | Mensajería Soporte | **PASA** | 1000 Mensajes procesados exitosamente. |
