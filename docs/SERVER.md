<h1 align="center">Server</h1>

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
