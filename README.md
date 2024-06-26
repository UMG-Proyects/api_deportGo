# Setup del Backend

## Ejecutar los siguientes comandos

```bash
git clone git@github.com:UMG-Proyects/api_deportGo.git
cd api_deportGo
composer install
```

## .env del Backend

Dentro del directorio donde clonamos el Backend, debemos de crear un archivo llamado `.env` y colocar el siguiente contenido:


```bash
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:8qDPNoSSIcOueRq7vL87nyEA8ZwvA0GMFJncwml4+mY=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=deportGo
DB_USERNAME=root
DB_PASSWORD=root

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DRIVER=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```
## BASE DE DATOS

```
create database deportGo
```

## Migraciones 
```bash
php artisan migrate
```
## Levantar proyecto local

```bash
# estar dentro del proyecto
php artisan serve
```

## Integrantes

- Jaime Alexander Rax Caal - 0902 20 15240
- Gilberto Arturo Sierra Rax - 0902 16 7372
- Gladis Madaí Cuc Tun - 0902 20 21166
- Emely Magaly Tecú Tecú - 0902 20 15520