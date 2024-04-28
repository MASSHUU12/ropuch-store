<h1 align="center">Database</h1>

You can create a database in two ways: via `Docker` or `XAMPP`.
Personally, I recommend the first solution.

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
