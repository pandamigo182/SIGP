# Guía de Despliegue en Azure (Azure for Students)

Esta guía detalla cómo publicar **SIGP** utilizando **Microsoft Azure**, aprovechando los beneficios de **Azure for Students** (sin tarjeta de crédito requerida).

## Prerrequisitos
1.  Activar tu cuenta: [Azure for Students](https://azure.microsoft.com/en-us/free/students/).
    *   Inicia sesión con tu correo institucional.
    *   No debería pedirte tarjeta, solo verificación por teléfono/correo.

---

## Paso 1: Crear la Base de Datos (MySQL Flexible Server)

El servicio PaaS es más fácil de manejar que instalar MySQL manualmente.

1.  En el [Portal de Azure](https://portal.azure.com), busca **"Azure Database for MySQL flexible servers"**.
2.  Haz clic en **Create**.
3.  **Configuración**:
    *   **Subscription**: Azure for Students.
    *   **Resource Group**: Crea uno nuevo llamado `SIGP_Resources`.
    *   **Server name**: Ej. `sigp-db-prod`.
    *   **Region**: East US (suele ser la más barata/disponible).
    *   **Workload type**: For development or hobby projects.
    *   **Compute + storage**: IMPORTANTE. Haz clic en "Configure Server".
        *   Elige **Burstable (B1s)**. Este es el más económico y suele estar incluido gratis por 12 meses.
    *   **Authentication**:
        *   Usuario: `sigp_admin`
        *   Contraseña: Crea una segura (¡Guárdala!).
4.  **Networking (Red)**:
    *   Marca **"Allow public access from any Azure service within Azure to this server"** (Vital para que la Web App se conecte).
    *   Agrega tu **IP actual** al firewall si quieres conectarte desde tu PC (para subir el SQL).
5.  **Review + create** > **Create**. (Tarda unos 5-10 min).

## Paso 2: Crear la Web App (App Service)

1.  Busca **"App Services"** en el portal.
2.  Haz clic en **Create** > **Web App**.
3.  **Configuración**:
    *   **Resource Group**: Selecciona `SIGP_Resources`.
    *   **Name**: Ej. `sigp-app-prod` (Esto creará `sigp-app-prod.azurewebsites.net`).
    *   **Publish**: Code.
    *   **Runtime stack**: **PHP 8.2** (o 8.1).
    *   **Operating System**: **Linux**.
    *   **Region**: East US (Misma que la BD).
    *   **Pricing Plan**: IMPORTANTE.
        *   Cambia al plan **Free F1** (Gratis de por vida) o **Basic B1** (se paga con tus créditos). Para producción real, B1 es mejor, pero F1 sirve para demos (aunque no soporta Always On). **Recomendación: Basic B1** usando tus créditos.
4.  **Deployment (GitHub)**:
    *   Activa "Continuous deployment".
    *   Conecta tu cuenta de GitHub.
    *   Selecciona tu organización/usuario y el repositorio `SIGP`.
    *   Branch: `main`.
5.  **Review + create** > **Create**.

## Paso 3: Configurar Entorno (Variables)

Una vez creada la Web App, ve a su panel de control:

1.  En el menú lateral, busca **Settings** > **Environment variables** (o Configuration).
2.  Agrega las siguientes "App settings":
    *   `DB_HOST`: *El nombre de tu servidor MySQL* (ej. `sigp-db-prod.mysql.database.azure.com`).
    *   `DB_USER`: `sigp_admin`.
    *   `DB_PASS`: *Tu contraseña*.
    *   `DB_NAME`: `sigp_db`.
    *   `URLROOT`: `https://sigp-app-prod.azurewebsites.net` (Tu URL real).
    *   `SMTP_USER`: Tu correo de SendGrid/Gmail.
    *   `SMTP_PASS`: Tu clave de App.
3.  Guarda los cambios.

## Paso 4: Preparar la Base de Datos

Necesitas subir las tablas a tu nueva BD en Azure.
1.  Usa una herramienta como **MySQL Workbench** o **HeidiSQL** en tu PC.
2.  Conéctate al servidor de Azure (usando el Host, Usuario y Pass del Paso 1).
    *   *Nota: Debes haber agregado tu IP en "Networking" del servidor MySQL en Azure.*
3.  Ejecuta el script `create database sigp_db;`.
4.  Importa tus archivos SQL:
    *   `public/databases/sigp_complete.sql`
    *   `public/databases/optimization_indexes.sql`

## Paso 5: Configurar Arranque (Startup Command)

Azure App Service a veces necesita saber dónde está la raíz pública.
1.  En la Web App, ve a **Configuration** > **General settings**.
2.  **Startup Command**:
    ```bash
    cp /home/site/wwwroot/.env.example /home/site/wwwroot/.env && service apache2 reload
    ```
    *En realidad, Azure configura Apache automáticamente para `/home/site/wwwroot`. Si tu `index.php` está en `/public`, necesitamos ajustar esto.*

    **Ajuste Crítico para MVC**:
    Azure apunta por defecto a la raíz. Si tu `index.php` está en `public/`, haz esto:
    1.  Ve a **Configuration** > **Path mappings** (o Environment Variables si mappings no está).
    2.  O simplemente crea un archivo `.htaccess` en la RAÍZ del repo (junto a `app`, `public`, etc.) para redirigir tráfico a `public/`.
    
    *Tu proyecto ya tiene estructura MVC. Asegúrate de que Azure apunte a `public`.*
    
    **Solución recomendada en Azure**:
    En **Configuration** > **General Settings** > **Startup Command**, pon:
    ```bash
    sed -i 's!/home/site/wwwroot!/home/site/wwwroot/public!g' /etc/apache2/sites-available/000-default.conf && /usr/sbin/apache2ctl -D FOREGROUND
    ```
    *Esto reescribe la config de Apache en Azure para que la raíz sea `/public`.*

## ¡Listo!
Visita `https://TU-APP.azurewebsites.net`. Azure detectará el cambio en GitHub, compilará y desplegará automáticamente.
