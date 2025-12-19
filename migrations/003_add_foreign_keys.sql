-- Migración: Añadir Foreign Keys para Integridad Referencial
-- Autor: AntiGravity
-- Fecha: 2025-12-19

-- Deshabilitar checks para evitar errores durante la creación masiva
SET FOREIGN_KEY_CHECKS=0;

-- 1. Tabla Usuarios
-- role_id -> roles(id)
-- empresa_id -> empresas(id)
-- institucion_id -> instituciones(id)
ALTER TABLE usuarios ADD CONSTRAINT fk_usuarios_role FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE usuarios ADD CONSTRAINT fk_usuarios_empresa FOREIGN KEY (empresa_id) REFERENCES empresas(id) ON DELETE SET NULL ON UPDATE CASCADE;
ALTER TABLE usuarios ADD CONSTRAINT fk_usuarios_institucion FOREIGN KEY (institucion_id) REFERENCES instituciones(id) ON DELETE SET NULL ON UPDATE CASCADE;

-- 2. Tabla Plazas
-- empresa_id -> usuarios(id) (Según lógica actual, las plazas pertenecen a un usuario tipo empresa o directamente a empresa? 
-- Revisando Plaza.php: "INNER JOIN usuarios ON plazas.empresa_id = usuarios.id" -> Parece que empresa_id apunta a la tabla USUARIOS (rol empresa).
-- IMPORTANTE: Validar esto. Si 'empresa_id' en plazas es el ID de usuario, la FK debe ser a usuarios.
-- Sin embargo, el nombre de columna es confuso. Verificar modelo.
-- Plaza.php linea 22: "ON plazas.empresa_id = usuarios.id" -> CONFIRMADO, apunta a usuarios.
ALTER TABLE plazas ADD CONSTRAINT fk_plazas_usuario_empresa FOREIGN KEY (empresa_id) REFERENCES usuarios(id) ON DELETE CASCADE ON UPDATE CASCADE;

-- 3. Tabla Postulaciones
-- plaza_id -> plazas(id)
-- estudiante_id -> usuarios(id) (Estudiante)
-- cv_id -> (Opcional, si existe tabla cvs, si no omitir)
ALTER TABLE postulaciones ADD CONSTRAINT fk_postulaciones_plaza FOREIGN KEY (plaza_id) REFERENCES plazas(id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE postulaciones ADD CONSTRAINT fk_postulaciones_estudiante FOREIGN KEY (estudiante_id) REFERENCES usuarios(id) ON DELETE CASCADE ON UPDATE CASCADE;

-- 4. Tabla Perfil Estudiantes
-- usuario_id -> usuarios(id)
-- carrera_id -> carreras(id)
ALTER TABLE perfil_estudiantes ADD CONSTRAINT fk_perfil_usuario FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE perfil_estudiantes ADD CONSTRAINT fk_perfil_carrera FOREIGN KEY (carrera_id) REFERENCES carreras(id) ON DELETE RESTRICT ON UPDATE CASCADE;

-- 5. Tabla Experiencia Laboral
-- usuario_id -> usuarios(id)
ALTER TABLE experiencia_laboral ADD CONSTRAINT fk_experiencia_usuario FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE ON UPDATE CASCADE;

-- 6. Tabla Certificados
-- usuario_id -> usuarios(id)
ALTER TABLE certificados ADD CONSTRAINT fk_certificados_usuario FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE ON UPDATE CASCADE;

-- 7. Tabla Usuario Habilidades
-- usuario_id -> usuarios(id)
-- habilidad_id -> habilidades(id)
ALTER TABLE usuario_habilidades ADD CONSTRAINT fk_uh_usuario FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE usuario_habilidades ADD CONSTRAINT fk_uh_habilidad FOREIGN KEY (habilidad_id) REFERENCES habilidades(id) ON DELETE CASCADE ON UPDATE CASCADE;

-- 8. Tabla Pasantias
-- estudiante_id -> usuarios(id)
-- empresa_id -> empresas(id) (OJO: Aquí Pasantia.php usa "LEFT JOIN empresas e ON p.empresa_id = e.id". 
-- A diferencia de Plazas, aquí parece apuntar a la tabla EMPRESAS real).
-- Revisar Pasantia.php Linea 17: "LEFT JOIN empresas e ON p.empresa_id = e.id".
-- CONFIRMADO: Apunta a tabla `empresas`.
-- tutor_id -> usuarios(id)
-- institucion_id -> instituciones(id)
ALTER TABLE pasantias ADD CONSTRAINT fk_pasantias_estudiante FOREIGN KEY (estudiante_id) REFERENCES usuarios(id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE pasantias ADD CONSTRAINT fk_pasantias_empresa FOREIGN KEY (empresa_id) REFERENCES empresas(id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE pasantias ADD CONSTRAINT fk_pasantias_tutor FOREIGN KEY (tutor_id) REFERENCES usuarios(id) ON DELETE SET NULL ON UPDATE CASCADE;
ALTER TABLE pasantias ADD CONSTRAINT fk_pasantias_institucion FOREIGN KEY (institucion_id) REFERENCES instituciones(id) ON DELETE SET NULL ON UPDATE CASCADE;

-- 9. Tabla Reportes
-- estudiante_id -> usuarios(id)
-- pasantia_id -> pasantias(id)
ALTER TABLE reportes ADD CONSTRAINT fk_reportes_estudiante FOREIGN KEY (estudiante_id) REFERENCES usuarios(id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE reportes ADD CONSTRAINT fk_reportes_pasantia FOREIGN KEY (pasantia_id) REFERENCES pasantias(id) ON DELETE CASCADE ON UPDATE CASCADE;

-- Reactivar checks
SET FOREIGN_KEY_CHECKS=1;
