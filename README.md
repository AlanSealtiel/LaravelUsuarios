## CRUD Laravel

Clonar el repositorio:

``
git clone https://github.com/AlanSealtiel/LaravelUsuarios.git
``

Abrir la carpeta del proyecto e instalar las dependencias de Laraverl con Composer

``
composer install
``

Crear archivo .htaccess en la raíz del proyecto

```
Options +FollowSymLinks -Indexes
RewriteEngine On

RewriteCond %{HTTP:Authorization} .
RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^ index.php [L]
```

Editar el archivo ``.env.example`` y quitarle la extensión ``.example``que solo quede ``.env``

Editar la línea 12, 13 y 14

````
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=CONTRASEÑA
````

Crear base de datos MySQL llamada laravel

Y ejecutar la sentencia

``php artisan migrate:fresh --sed``

Se creará una tabla llamada users en la base de datos con registros.

De lo contrario pueden crear la tabla de la base de datos con la siguiente estructura

````
CREATE TABLE `users` (
  `id_cliente` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `clave` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_com` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `raz_soc` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rfc` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `edad` smallint(6) DEFAULT NULL,
  `domicilio` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estatus` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_cliente`),
  UNIQUE KEY `users_clave_unique` (`clave`),
  UNIQUE KEY `users_rfc_unique` (`rfc`)
) ENGINE=InnoDB CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
````

iniciar el proyecto

``php artisan serve``

Abrir la URL en el navegador http://localhost:8000/usuarios
