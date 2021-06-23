<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

# Laravel SPA Template

## Requisitos previos

- Composer
- NodeJS & NPM
- Configuración de VirtualHost

## Instalación

```sh
git clone http://sandbox.ucsc.cl/desarrollo/laravel-spa-template.git nombreproyecto     # clonación del proyecto
cd nombreproyecto                                                                       # entra al directorio del proyecto
composer install                                                                        # instala dependencias de Laravel
npm install                                                                             # instala dependencias de NodeJS
chown -R apache:apache storage                                                          # cambia al dueño a apache, para evitar errores de permisos
cp .env.example .env                                                                    # copia la base del archivo .env
php artisan key:generate                                                                # genera una nueva key de encriptación
```

En caso de tener errores de permisos (*"The stream or file "/var/www/html/apps/laravel-spa-template/storage/logs/laravel-2019-10-03.log" could not be opened: failed to open stream: Permission denied"*) ejecutar lo siguiente:

```sh
chcon -R -t httpd_sys_rw_content_t storage
```

## Configuración

### Dotenv

En el archivo ``.env`` debes cambiar los siguientes parámetros:

- APP_NAME: nombre del proyecto.
- APP_URL: como el nombre indica, la URL del proyecto, por ejemplo: ``http://template.jgamonal.devel``.
- DB_*: configuración de motores de base de datos.

### Composer

En el archivo ``composer.json`` debes cambiar los parámetros siguientes según la necesidad:

- name: nombre del proyecto.
- description: breve descripción del proyecto.

### Service providers

En el archivo ``config/app.php`` puedes comentar las líneas de los **Service Providers** que no utilices, por ejemplo el servicio de **Console**.

### SPA dentro de un mismo subdominio

En caso de querer tener dos aplicaciones Laravel corriendo bajo el mismo namespace debes hacer unas configuraciones extra.
Un ejemplo de esto sería tener algo así:

- http://docencia.ucsc.cl/curriculum/app_uno
- http://docencia.ucsc.cl/curriculum/app_dos

Las configuraciones necesarias son:

- ``resources/js/app.js``: descomentar la línea de *base* en la configuración de **VueRouter**.
- ``public/.htaccess``: descomentar la línea *RewriteBase* y definir la ruta según la necesidad.

### Configuración extra

#### Bootstrap y jQuery:

Aunque venga integrado, no siempre se va a requerir compilar estos dos, ya que deberían ser cargados en el frame principal de portal. En caso de necesitarlos (idealmente para desarrollo solamente) debes hacer lo siguiente:

- ``resources/js/bootstrap.js``: descomentar las líneas que importan **Popper, jQuery y Bootstrap**.
- ``resources/sass/app.scss``: descomentar la línea que importa **Bootstrap**.
