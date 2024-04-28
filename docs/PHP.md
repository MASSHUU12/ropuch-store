<h1 align="center">PHP</h1>

If you want to install PHP manually, you can find instructions [here](https://www.php.net/manual/en/install.php).

The easiest way is to simply download the ZIP containing PHP, unpack it into some folder and save the path to it in the PATH variable.

### If errors occur

Make sure that these PHP extensions are enabled in php.ini:

- pdo_pgsql
- fileinfo
- xml

On Fedora make sure that `php-mysqli` and `php-pdo` are installed.
