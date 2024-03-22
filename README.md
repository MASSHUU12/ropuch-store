<h1 align="center">Ropuch</h1>

## Prerequisites

-   [PHP 8^](https://www.php.net/downloads.php) or [XAMPP](https://www.apachefriends.org/download.html)
-   [Composer](https://getcomposer.org/)
-   [Docker](https://www.docker.com/products/docker-desktop/), for database or [XAMPP](https://www.apachefriends.org/download.html)
-   [Bruno](https://www.usebruno.com/downloads) or other API client

## Setup

### Server

To run server use `php artisan serve`.

If you want the server to be available on the local network, use:

```bash
> php artisan serve --host=your_local_ip
```

The API can be accessed at http://localhost:8000/api/

#### First-time configuration

**Copy** the `.env.example` file, rename it to `.env` and continue:

```bash
> composer install
> php artisan key:generate --ansi
> php artisan serve
```

### Database

You can create a database in two ways: via `Docker` or `XAMPP`. Personally, I recommend the first solution.
`Docker` allows you to create an isolated environment for containers,
so you can be sure that a service will work exactly the same way as others.
`XAMPP`, on the other hand, although it seems simpler and installs PHP out-of-the-box is very unstable and problematic.

Regardless of what you choose, the effect will be similar, both solutions use `MariaDB` and `phpMyAdmin`.

If you want to reset the database to its initial state use `php artisan migrate:fresh`.

<!-- php artisan db:seed -->

#### Database via Docker

Run `Docker Desktop`.

Web interface is available at http://localhost:8080/.

##### First-time configuration

1. From the root folder run: `docker compose up`.
2. Now run `php artisan migrate:fresh` in terminal.

#### Database via XAMPP

Run XAMPP Control Panel and enable `MySQL` module,
optionally you can enable `Apache` module if you want to manage database via web interface.

##### First-time configuration

1. Enable `Apache` module in XAMPP Control Panel.
2. Go to http://localhost/phpmyadmin/.
3. Create new database named `ropuch`.
4. Now run `php artisan migrate:fresh` in terminal.
5. You can disable `Apache` module.

### IDE

You can use IDE of your choice, but I recommend PhpStorm or VSCode, both perform very well.

In the case of VSCode, the repository includes several settings that improve its operation with PHP, as well as recommended extensions that should appear in the Extensions tab, so you can download them right away.

### PHP

If you want to install PHP manually, you can find instructions [here](https://www.php.net/manual/en/install.php).

The easiest way is to simply download the ZIP containing PHP, unpack it into some folder and save the path to it in the PATH variable.

### If errors occur

Make sure that these PHP extensions are enabled in php.ini:

-   pdo_pgsql
-   fileinfo
