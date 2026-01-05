# Visión General del Sistema - SIGP

> **Documento Técnico de Referencia**
> **Proyecto:** Sistema Integral de Gestión de Pasantías
> **Versión:** 1.0 (Final)
> **Fecha:** Diciembre 2025

---

## Tabla de Contenidos
1.  [Misión](#misión)
2.  [Alcance](#alcance)
3.  [Actores Principales](#actores-principales)
4.  [Arquitectura Lógica](#arquitectura-lógica)
5.  [Seguridad y Normativa](#seguridad-y-normativa-iso)

---

## Misión
Proveer una plataforma centralizada, eficiente y equitativa que conecte el talento académico con las necesidades del sector empresarial, simplificando la gestión administrativa de pasantías.

## Alcance
El sistema cubre todo el ciclo de vida de la práctica profesional:
1.  **Fase Previa**: Registro de actores, validación de perfiles y publicación de ofertas.
2.  **Fase Activa**: Postulación, selección y formalización del inicio de pasantía.
3.  **Fase de Cierre**: Evaluación de desempeño, retroalimentación y generación de constancias.

## Actores Principales

### Estudiante
Usuario final que busca oportunidades de desarrollo profesional. Requiere herramientas para destacar su perfil y simplificar la postulación.

### Empresa
Entidad que ofrece espacios de aprendizaje. Busca herramientas eficientes de filtrado y gestión de candidatos para optimizar sus procesos de reclutamiento.

### Institución (Admin/Coordinador)
Ente regulador. Supervisa que las prácticas cumplan con los reglamentos académicos, valida empresas y emite las acreditaciones finales.

## Arquitectura Lógica
El sistema sigue un patrón Modelo-Vista-Controlador (MVC) estricto, separando la lógica de negocio de la presentación, lo que facilita el mantenimiento y la auditoría del código.

## Seguridad y Normativa (ISO)
El SIGP ha sido auditado y fortalecido para cumplir con estándares internacionales:
*   **ISO/IEC 27001 (Seguridad)**: Implementación de controles de acceso robustos, bitácora inmutable de eventos críticos y criptografía de grado militar.
*   **Gestión de Credenciales**: Uso del algoritmo **Argon2id**, resistente a ataques de fuerza bruta por hardware (GPU/ASIC).
*   **Observabilidad Total**: Sistema de monitoreo de errores fatales (Error 500) en tiempo real, visibles solo para administradores.
