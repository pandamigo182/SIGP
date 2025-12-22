# Guía de Despliegue en Digital Ocean (GitHub Student Pack)

Esta guía detalla cómo publicar el proyecto **SIGP** en internet utilizando los créditos gratuitos ($200) que ofrece Digital Ocean para estudiantes a través del GitHub Student Developer Pack.

## Prerrequisitos
1.  Cuenta en [GitHub Education](https://education.github.com/pack).
2.  Canjear los créditos de Digital Ocean en el panel de beneficios de GitHub.
3.  Acceso al código fuente (Repositorio Privado o la carpeta actual).

## Herramientas Recomendadas (GitHub Student Pack)
Para maximizar el éxito de tu despliegue, te recomiendo activar estos beneficios del pack:

| Herramienta | Categoría | Uso en SIGP |
| :--- | :--- | :--- |
| **Namecheap** | Dominio/SSL | Obtén un dominio `.me` gratis por 1 año y certificados SSL. Da profesionalismo a tu proyecto (ej. `misigp.me`). |
| **Termius** | SSH Client | Cliente SSH Premium. Facilita la conexión a tu servidor Digital Ocean y la transferencia de archivos (SFTP) sin comandos complejos. |
| **JetBrains** | IDE | Licencia gratuita de **PhpStorm**. Es el IDE estándar de la industria para PHP; esencial para la refactorización hacia V2.0. |
| **SendGrid** | Email API | (Plan Estudiante) Permite enviar correos de "Recuperar Contraseña" de forma masiva sin riesgo de que Gmail bloquee tu cuenta personal. |
| **GitKraken** | Git GUI | Cliente visual para Git. Ayuda a gestionar ramas y fusiones complejas de forma visual (versión Pro gratis). |

---

## Paso 1: Crear el Servidor (Droplet)

1.  Inicia sesión en **Digital Ocean**.
2.  Haz clic en **Create** > **Droplet**.
3.  **Configuración Recomendada**:
    *   **Region**: New York o San Francisco.
    *   **OS**: Ubuntu 22.04 LTS.
    *   **Size**: Basic > Regular > **$6/mes** (1GB RAM / 1 CPU). Suficiente para empezar.
    *   **Authentication**: Elige **Password** y crea una contraseña segura (o usa SSH Key si sabes generarla).
    *   **Hostname**: `sigp-server`.
4.  Haz clic en **Create Droplet**. Espera 1 minuto hasta que te den una **IP Address** (ej. `192.168.1.100`).

## Paso 2: Conectar al Servidor

Usa una terminal (PowerShell o CMD) para conectar vía SSH:
```bash
ssh root@TU_IP_DEL_DROPLET
# Introduce la contraseña que creaste.
```

## Paso 3: Instalar el Entorno (LAMP Stack)

Copia y pega estos comandos en la terminal de tu servidor para instalar Apache, MySQL y PHP:

```bash
# Actualizar sistema
apt update && apt upgrade -y

# Instalar Servidor Web, Base de Datos y PHP
apt install apache2 mysql-server php8.1 php8.1-mysql php8.1-curl php8.1-xml php8.1-mbstring php8.1-gd libapache2-mod-php8.1 unzip git -y

# Habilitar mod_rewrite (Vital para el MVC)
a2enmod rewrite
service apache2 restart
```

## Paso 4: Subir el Proyecto

Hay dos formas. La más fácil es clonar tu repositorio si está en GitHub.

```bash
cd /var/www/html
rm index.html
git clone https://github.com/TU_USUARIO/SIGP.git .
# Si es privado, te pedirá usuario y un "Personal Access Token" como contraseña.

# Instalar dependencias PHP
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
composer install
```

## Paso 5: Configurar Base de Datos MySQL

1.  Entra a MySQL: `mysql`
2.  Crea la BD y Usuario:
```sql
CREATE DATABASE sigp_db;
CREATE USER 'sigp_user'@'localhost' IDENTIFIED BY 'TU_CONTRASEÑA_SECURE';
GRANT ALL PRIVILEGES ON sigp_db.* TO 'sigp_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```
3.  Importa los datos (Sube tu .sql con FileZilla o usa `nano` para pegar el contenido):
```bash
# Ejemplo si ya tienes el archivo sql en el repo
mysql -u sigp_user -p sigp_db < /var/www/html/public/databases/sigp_complete.sql
# Ejecuta también la optimización
mysql -u sigp_user -p sigp_db < /var/www/html/public/databases/optimization_indexes.sql
```

## Paso 6: Configurar Apache y Variables de Entorno

1.  Crear archivo `.env`:
```bash
cp .env.example .env
nano .env
# Edita DB_HOST=localhost, DB_USER=sigp_user, DB_PASS=TU_CONTRASEÑA...
# Ctrl+X, Y, Enter para guardar.
```

2.  Configurar VirtualHost para que las rutas funcionen:
```bash
nano /etc/apache2/sites-available/000-default.conf
```
Dentro de `<VirtualHost *:80>`, añade/modifica:
```apache
DocumentRoot /var/www/html
<Directory /var/www/html>
    Options Indexes FollowSymLinks
    AllowOverride All
    Require all granted
</Directory>
```
3.  Reiniciar Apache: `service apache2 restart`

## Paso 7: Permisos de Carpetas
Para que se puedan subir imágenes de perfil y CVs:
```bash
chown -R www-data:www-data /var/www/html
chmod -R 775 /var/www/html/public/uploads
```

## ¡Listo!
Accede a `http://TU_IP_DEL_DROPLET` en tu navegador. Deberías ver el sistema funcionando.

---
### Extra: Dominio y SSL (Candado Verde)
Si compras un dominio (ej. `misigp.com`) en Namecheap (también gratis con GitHub Pack):
1.  Apunta los DNS (A Record) a la IP de tu Droplet.
2.  En el servidor ejecuta: `apt install certbot python3-certbot-apache -y`
3.  Lanza: `certbot --apache` y sigue las instrucciones.
