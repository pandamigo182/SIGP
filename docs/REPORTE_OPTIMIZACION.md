# Reporte de Optimización y Escalabilidad - SIGP

**Fecha:** 22 de Diciembre de 2025
**Objetivo:** Preparar el sistema para alta concurrencia pública (Proyecto Leviatán).

## 1. Análisis de Rendimiento Actual
Las pruebas de estrés bajo el protocolo "Leviatán" arrojaron los siguientes resultados preliminares:
*   **Capacidad de Carga**: El sistema soporta 200 usuarios concurrentes, pero con tiempos de respuesta > 7 segundos.
*   **Resiliencia**: El servidor resiste ataques de inundación (DoS) básicos sin colapsar, pero con consumo elevado de recursos.
*   **Soporte**: El módulo de contacto es funcional pero carece de colas de procesamiento, lo que ralentiza la respuesta síncrona.

## 2. Recomendaciones de Optimización (Backend)

### A. Caché y Base de Datos
1.  **Implementar Redis/Memcached**: Almacenar sesiones y consultas frecuentes (ej. configuración del sistema, catálogos de departamentos) en memoria para reducir hits a MySQL.
2.  **Índices SQL**: Asegurar que campos como `email`, `role_id`, `departamento` y claves foráneas tengan índices optimizados.
3.  **OPcache**: Habilitar y ajustar `opcache.memory_consumption` y `opcache.max_accelerated_files` en `php.ini` para compilación JIT.

### B. Seguridad y Red
1.  **Rate Limiting**: Configurar `mod_evasive` en Apache o limitar peticiones por IP a nivel de firewall (WAF) para mitigar ataques DoS.
2.  **CDN**: Servir activos estáticos (CSS, JS, Imágenes) a través de una CDN (ej. Cloudflare) para reducir latencia global.

## 3. Recomendaciones Frontend (UX/Velocidad)
1.  **Minificación**: Comprimir archivos `style.css` y `main.js`.
2.  **Lazy Loading**: Implementar carga diferida para imágenes de perfil y logotipos de empresas.
3.  **Feedback Visual**: Mejorar indicadores de carga (spinners) en formularios críticos como Login y Contacto.

## 4. Estrategia de Monitoreo
*   **Logs en Tiempo Real**: Configurar rotación de logs de errores.
*   **Alertas**: Implementar notificaciones automáticas a administradores ante picos de CPU > 80%.

## 5. Próximos Pasos (Roadmap Técnico)
*   **Fase 1**: Habilitar OPcache y Caché de Consultas (Inmediato).
*   **Fase 2**: Migrar envío de correos a colas asíncronas (RabbitMQ/Database Queues).
*   **Fase 3**: Implementar WAF y Balanceador de Carga si el tráfico excede 10k usuarios diarios.
