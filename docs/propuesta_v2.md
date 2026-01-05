# Propuesta Técnica SIGP V2.0

> **Hoja de Ruta Tecnológica**
> **Proyecto:** Sistema Integral de Gestión de Pasantías
> **Versión:** 1.0 (Final)
> **Fecha:** Diciembre 2025

---

## Tabla de Contenidos
1.  [Resumen Ejecutivo](#resumen-ejecutivo)
2.  [Objetivos](#objetivos)
3.  [Stack Tecnológico Propuesto](#stack-tecnológico-propuesto)
4.  [Roadmap de Migración](#roadmap-de-migración-estimado-3-meses)

---

## Resumen Ejecutivo
La versión 2.0 (V2.0) de SIGP busca modernizar la arquitectura tecnológica, migrando hacia frameworks robustos que permitan mayor escalabilidad y mantenibilidad.

## Objetivos
1.  **Migración a Framework**: Adoptar Laravel como motor principal.
2.  **Interfaz Reactiva**: Implementar Livewire o Vue.js para interacciones dinámicas.
3.  **API First**: Exponer una API RESTful para futuras aplicaciones móviles.

## Stack Tecnológico Propuesto

| Capa | V1.0 (Actual) | V2.0 (Propuesta) |
| :--- | :--- | :--- |
| **Backend** | PHP Nativo Seguro (Argon2id + ISO 27001) | Laravel 11 |
| **Frontend** | Bootstrap 5 + jQuery/Vanilla | Tailwind CSS + Livewire |
| **Base de Datos** | MySQL | PostgreSQL / MySQL 8+ |
| **Infraestructura** | XAMPP/VPS Tradicional | Docker + CI/CD Pipelines |

## Roadmap de Migración (Estimado: 3 Meses)

### Fase 1: Arquitectura y Modelado (Mes 1)
*   Instalación de Laravel y configuración de entorno Docker.
*   Migración de esquema de base de datos a migraciones de Laravel.
*   Definición de Modelos y Relaciones Eloquent.

### Fase 2: Lógica de Negocio y API (Mes 2)
*   Desarrollo de Controladores y Servicios.
*   Implementación de Autenticación (Laravel Sanctum/Fortify).
*   Desarrollo de Endpoints API.

### Fase 3: Frontend y UX (Mes 3)
*   Diseño de componentes Blade/Livewire.
*   Integración de dashboard administrativo (FilamentPHP recomendado).
*   Pruebas de aceptación de usuario (UAT).
