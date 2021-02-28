<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Binary tree builder

Installation instructions:

- **Clone the repo**
- `cd btree/`
- `composer require laravel/sail --dev` 
- `cp .env.example .env`
- `php artisan sail:install`

It will prompt you to choose what services to install. E.g. mysql, pgsql etc.
Choose `redis`
- **Run `./vendor/bin/sail up`** or `./vendor/bin/sail up -d` to run in the background

You may also want to configure a Bash alias:
- **alias sail='bash vendor/bin/sail'**

After the setup has finished, go to:

- **http://localhost/main**

You should be able to see a simple form that accepts .txt files

Run tests:

- **docker exec -it btree_laravel.test_1 php artisan test**

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
