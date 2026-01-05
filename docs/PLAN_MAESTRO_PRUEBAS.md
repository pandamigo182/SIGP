# Plan Maestro de Pruebas - SIGP

**Proyecto:** Sistema Integral de Gestión de Pasantías (SIGP)
**Versión:** 1.0 (Release Candidate)
**Fecha:** Diciembre 2025
**Responsable de QA:** Equipo de Desarrollo SIGP

---

## 1. Introducción
Este documento define la estrategia de pruebas para validar la calidad, seguridad y funcionalidad del sistema SIGP antes de su despliegue en producción. Se basa en las normas ISO 25010 (Calidad de Software) e ISO 27001 (Seguridad).

## 2. Alcance
Las pruebas cubrirán los siguientes módulos:
*   Autenticación y Seguridad (Login, Registro, Recuperación).
*   Módulo de Estudiantes (Perfil, Postulaciones, Reportes).
*   Módulo de Empresas (Plazas, Selección, Evaluaciones).
*   Infraestructura y Base de Datos.

---

## 3. Plantillas de Casos de Prueba ("Machotes")

A continuación se presentan las fichas técnicas para la ejecución de pruebas.

### 3.1 Pruebas de Instalación y Despliegue

| ID Caso | INS-001 |
| :--- | :--- |
| **Nombre** | Despliegue Limpio en Servidor Ubuntu/Apache |
| **Prerrequisitos** | Servidor con LAMP Stack instalado. Acceso SSH. |
| **Pasos** | 1. Clonar el repositorio `git clone ...`<br>2. Copiar `.env.example` a `.env` y configurar BD.<br>3. Ejecutar `composer install`.<br>4. Importar `sigp_complete.sql`. |
| **Resultado Esperado** | Al navegar a la IP del servidor, la página de inicio carga sin errores 500. |
| **Estado** | [ ] Pasa / [ ] Falla |

| ID Caso | INS-002 |
| :--- | :--- |
| **Nombre** | Verificación de Migraciones y Datos Semilla |
| **Prerrequisitos** | Base de Datos vacía previamente. |
| **Pasos** | 1. Importar script SQL.<br>2. Consultar tabla `usuarios` (debe haber admin).<br>3. Consultar tabla `departamentos` (debe tener 14 registros). |
| **Resultado Esperado** | Datos de referencia cargados correctamente. |
| **Estado** | [ ] Pasa / [ ] Falla |

---

### 3.2 Pruebas Funcionales (Caja Negra)

| ID Caso | FUN-AUTH-01 |
| :--- | :--- |
| **Nombre** | Login con Credenciales Inválidas |
| **Actor** | Usuario General |
| **Pasos** | 1. Ir a `/auth/login`.<br>2. Ingresar email no registrado.<br>3. Clic en "Ingresar". |
| **Resultado Esperado** | Mensaje de error "Usuario no encontrado" o "Credenciales incorrectas". No permite acceso. |
| **Estado** | [ ] Pasa / [ ] Falla |

| ID Caso | FUN-STD-01 |
| :--- | :--- |
| **Nombre** | Postulación a Plaza |
| **Actor** | Estudiante |
| **Pasos** | 1. Loguearse como Estudiante.<br>2. Ir a "Pasantías".<br>3. Seleccionar plaza "Dev Jr".<br>4. Clic en "Aplicar". |
| **Resultado Esperado** | 1. Mensaje de éxito (Toast).<br>2. Botón cambia a "Pendiente".<br>3. Registro en tabla `postulaciones`. |
| **Estado** | [ ] Pasa / [ ] Falla |

---

### 3.3 Pruebas de Seguridad (ISO 27001)

| ID Caso | SEC-001 |
| :--- | :--- |
| **Nombre** | Protección Contra Fuerza Bruta (Argon2id) |
| **Herramienta** | Script de Auditoría / Intentos manuales |
| **Pasos** | 1. Intentar loguear 10 veces seguidas con pass incorrecto (si aplica rate limit).<br>2. Verificar hash en BD. |
| **Resultado Esperado** | Las contraseñas en BD deben empezar con `$argon2id$`. El tiempo de verificación debe ser perceptible (>200ms) para evitar ataques rápidos. |
| **Estado** | [ ] Pasa / [ ] Falla |

| ID Caso | SEC-002 |
| :--- | :--- |
| **Nombre** | Prevención de XSS Reflejado |
| **Pasos** | 1. Intentar inyectar `<script>alert(1)</script>` en campos de búsqueda o URL p.ej. `?email=<script>`. |
| **Resultado Esperado** | El script no se ejecuta. El input se muestra sanitizado (texto plano). |
| **Estado** | [ ] Pasa / [ ] Falla |

---

### 3.4 Pruebas de Carga (Stress Testing - Omega)

| ID Caso | PERF-001 |
| :--- | :--- |
| **Nombre** | Resistencia a 100 Usuarios Concurrentes |
| **Herramienta** | Apache JMeter / Locust |
| **Pasos** | 1. Simular 100 usuarios navegando en Home y Plazas simultáneamente. |
| **Resultado Esperado** | Tiempo de respuesta promedio < 500ms. CPU del servidor < 80%. |
| **Estado** | [ ] Pasa / [ ] Falla |

---

## 4. Criterios de Aceptación
El software se considerará listo para producción cuando:
1.  100% de Pruebas Críticas (Instalación y Seguridad) sean aprobadas.
2.  95% de Pruebas Funcionales aprobadas (sin bugs bloqueantes).
3.  Documentación técnica completa y aprobada.

**Aprobado por:** ____________________  **Fecha:** __________
