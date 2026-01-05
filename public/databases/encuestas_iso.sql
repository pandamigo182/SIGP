-- Tabla para Encuestas de Satisfacción (ISO 9001)
CREATE TABLE IF NOT EXISTS `encuestas_satisfaccion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `tipo_usuario` enum('estudiante','empresa') NOT NULL,
  `nivel_satisfaccion` int(1) NOT NULL COMMENT '1-5 Escala',
  `facilidad_uso` int(1) NOT NULL COMMENT '1-5 Escala',
  `calidad_soporte` int(1) NOT NULL COMMENT '1-5 Escala',
  `comentarios` text,
  `fecha` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_encuesta_usuario` (`usuario_id`),
  CONSTRAINT `fk_encuesta_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
