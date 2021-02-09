# Casino-php

Sistema para monitorear una mesa de casino.

## Instalación 

### Prerequisitos

* Composer
* Postgres
* Servidor LAPP

### OS Linux

1. Clonar el proyecto
```bash
$ git clone https://github.com/gm9510/Casino-php

$ cd Casino-php/
```


2. Instalar librerias con Composer
```bash
/Casino-php$ Composer install
```

3.Conectar con la base de datos:

Para esto podemos modificar el archivo `.env` o crear el archivo `.env.local` aquí configuramos el entorno. Agregamos la siguiente linea con la información de la base de datos respectiva.

```bash
# Casino-PHP/.env.local
DATABASE_URL="postgresql://db_user:db_password@127.0.0.1:5432/db_name?serverVersion=13&charset=utf8"
```

4.Migración de datos

Migramos la información de las tablas a la base de datos con el comando

```bash
/Casino-php$ php bin/console doctrine:migrations:migrate
```

5. Servidor 

En el caso de Symfony + Apache2, se debe configurar la raiz de la Webapp en el directorio public, a continuación la configuración de apache en la que se construyó esta Webapp

```apache
<VirtualHost *:8080>
	ServerAdmin webmaster@localhost
	DocumentRoot /var/www/Casino-php/public/
	DirectoryIndex /index.php

	<Directory "/var/www/Casino-php/public/">
		FallbackResource /index.php
	</Directory>

	ErrorLog ${APACHE_LOG_DIR}/error.log
	CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>

```

## Heroku

Puede observar la Webapp en funcionamiento en el siguiente link:

[Casino Ruleta](https://cryptic-escarpment-99484.herokuapp.com/index.php)
