ALTER TABLE configuracion
DROP COLUMN facebook,
DROP COLUMN instagram,
DROP COLUMN twitter,
DROP COLUMN linkedin;

ALTER TABLE configuracion
ADD COLUMN departamento_id INT DEFAULT NULL,
ADD COLUMN municipio_id INT DEFAULT NULL,
ADD COLUMN distrito_id INT DEFAULT NULL;
