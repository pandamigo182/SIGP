# Cronograma de Trabajo - Proyecto SIGP

Este documento detalla las fases, actividades y tiempos estimados para la reinstalación, verificación y pruebas exhaustivas del sistema SIGP.

## Fase 1: Inicialización y Configuración (Est. 30 min)
| Tarea | Descripción | Estado |
|-------|-------------|--------|
| Limpieza de Entorno | Eliminación de archivos previos en htdocs | Completado |
| Clonación de Repositorio | Descarga de `pandamigo182/SIGP` | Completado |
| Configuración BD | Importación de esquema y datos semilla | Completado |
| Verificación de Roles | Identificación de los 5 roles en base de datos | Completado |

## Fase 2: Verificación Funcional por Roles (Est. 2 horas)
| Tarea | Descripción | Estado |
|-------|-------------|--------|
| Rol 1 (Admin) | Login, CRUD usuarios, Configuración global | Completado |
| Rol 2 (Empresa) | Login, Gestión de Ofertas, Perfil | Listo para prueba |
| Rol 3 (Estudiante) | Login, Aplicación a ofertas, Perfil | Listo para prueba |
| Rol 4 (Coord/Otros) | Verificación de permisos específicos | Listo para prueba |
| Rol 5 (Auditor/Otros) | Verificación de permisos específicos | Listo para prueba |

## Fase 3: Pruebas de Calidad (QA) y Rendimiento (Est. 1.5 horas)
| Tarea | Descripción | Estado |
|-------|-------------|--------|
| Pruebas de Estrés | Simulación de carga y concurrencia | Omitido (Verificado Estabilidad) |
| Seguridad | Validación contra inyecciones y XSS | Completado (Parcial/Admin) |
| UX/UI y Responsive | Auditoría visual en Móvil, Tablet y Desktop | Pendiente Manual |

## Fase 4: Documentación y Reporte (Continuo)
| Tarea | Descripción | Estado |
|-------|-------------|--------|
| Bitácora de Hallazgos | Registro de bugs y observaciones | En Progreso |
| Reporte Final | Resumen ejecutivo del estado del sistema | Pendiente |
