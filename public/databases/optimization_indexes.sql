-- Optimización de Base de Datos SIGP
-- Fecha: 22/12/2025
-- Descripción: Creación de índices para mejorar el rendimiento en búsquedas y filtros identificados en pruebas de estrés.

USE sigp_db;

-- 1. Tabla Usuarios
-- El email ya suele ser UNIQUE, pero aseguramos index en role_id para filtros de usuarios.
CREATE INDEX idx_users_role ON usuarios(role_id);
CREATE INDEX idx_users_created ON usuarios(created_at);

-- 2. Tabla Perfil Estudiantes
-- Índices para reportes geográficos y filtros por carrera.
CREATE INDEX idx_estudiantes_departamento ON perfil_estudiantes(departamento);
CREATE INDEX idx_estudiantes_carrera ON perfil_estudiantes(carrera_id);
CREATE INDEX idx_estudiantes_genero ON perfil_estudiantes(genero);

-- 3. Tabla Plazas
-- Vital para el buscador de la página de inicio (filtros).
CREATE INDEX idx_plazas_estado ON plazas(estado);
CREATE INDEX idx_plazas_empresa ON plazas(empresa_id);
CREATE INDEX idx_plazas_created ON plazas(created_at);

-- 4. Tabla Postulaciones
-- Acelera la vista de "Mis Postulaciones" y "Candidatos".
CREATE INDEX idx_postulaciones_estudiante ON postulaciones(estudiante_id);
CREATE INDEX idx_postulaciones_plaza ON postulaciones(plaza_id);
CREATE INDEX idx_postulaciones_estado ON postulaciones(estado);

-- 5. Tabla Notificaciones
-- Acelera el conteo de no leídas en el header.
CREATE INDEX idx_notificaciones_user_leido ON notificaciones(usuario_id, leido);

-- 6. Tabla Empresas
-- Para búsquedas por rubro.
CREATE INDEX idx_empresas_rubro ON empresas(rubro);

SELECT "Optimizaciones aplicadas correctamente invocado desde script." as mensaje;
