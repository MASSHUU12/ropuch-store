<h1 align="center">Server</h1>

To run server use `php artisan serve`.

If you want the server to be available on the local network, use:

```bash
> php artisan serve --host=your_local_ip
```

The API can be accessed at http://localhost:8000/api/

## First-time configuration

**Copy** the `.env.example` file, rename it to `.env` and continue:

```bash
> composer install
> php artisan key:generate --ansi
> php artisan serve
```

## Server communication

The easiest way to communicate with the server is through [Bruno](https://www.usebruno.com/downloads).
Bruno allows you to write as well as read ready queries from files, so everyone can use them.

Queries can be found, and should be saved at `/docs/bruno/Ropuch`.
