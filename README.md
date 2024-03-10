<h1 align="center">Ropuch</h1>

## Prerequisites

- [PHP 8^](https://www.php.net/downloads.php)
- [Composer](https://getcomposer.org/)
- [Docker](https://www.docker.com/products/docker-desktop/), for database (optional)

Make sure to enable these PHP extensions in php.ini:

- pdo_pgsql
- fileinfo

## Setup

### Server

Copy the `.env.example` file and rename it to `.env`.
Customize the .env file to suit your needs and continue:

```bash
> composer install
> php artisan key:generate --ansi
# php artisan migrate:fresh
# php artisan db:seed
> php artisan serve
```

If you want the server to be available on the local network, use:

```bash
> php artisan serve --host=<IP>:8000
```

The API can be accessed at http://localhost:8000/api/

### Database setup (Docker)

- From the root folder run: `docker compose up`.

The remaining steps are optional if you want to access the database from the browser:

- Go to http://localhost:5050 and login using `admin@admin.com` and `root` (defined in `docker-compose.yml`).
- Click `Add new server`.
- Select the `General` tab. For the `name` field, use any name.
- Select the `Connection` tab. For `host name`, `port`, `username` and `password` use data `from docker-compose.yml`.
- Click `Save`.
