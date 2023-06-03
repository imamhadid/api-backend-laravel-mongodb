# Laravel MongoDB

I thank you for visiting this repository, I hope it helps and is useful for those who need it, this is the beginning of me starting to use Laravel again after a vacuum after about 8 months, sorry maybe if there is something messy in this source code due to some This past month I've been using NodeJs more often. If you find a problem you can contact me or look at the documentation in this ReadMe.

## About Project

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects. This project contains standard APIs for login and registration for auth and also a REST API for vehicle sales with using Service Repository Pattern.

Required:
- Laravel 8.0
- PHP 7.3|^8.0
- Mongodb 4.2
- MongoDB driver for PHP 
    - Windows: https://pecl.php.net/package/mongodb
    - Linux: sudo pecl install mongodb
- php.ini driver enable or write it
> extension=mongodb


Packaget:
- jenssegers/mongodb ^3.8
> sudo composer require jenssegers/mongodb

- jason-guru/laravel-make-repository
> sudo composer require jason-guru/laravel-make-repository --dev

- tymon/jwt-auth
> sudo composer require tymon/jwt-auth

## How To Setup

- Clone Repositori
> Command CLI: git clone
- Enter Folder
> cd api-backend-test
- Setting Env
>   sudo cp .env.example .env

>   sudo vim .env

>    ``````
>    DB_CONNECTION=
>    DB_HOST=
>    DB_PORT=
>    DB_DATABASE=
>    DB_USERNAME=
>    DB_PASSWORD=
>    ``````

>   sudo php artisan key:generate


## Unit Test

> sudo php artisan test --filter AuthTest

My Result
`````
    ✓ register
    ✓ login with valid credentials
    ✓ login with invalid credentials


    Tests:  3 passed
    Time:   3.23s
`````

## Running Serve

- Migrate database
>   sudo php artisan migrate

- Artisan Serve Project
>   sudo php artisan serve

### Special Giving Thanks to

- **[PT. INOSOFT TRANS SISTEM](https://inosoftweb.com/)**



## For More Documentation

- [Laravel documentation](https://laravel.com/docs/contributions).
- [Linkedin FAQ 'Imam Hadid'](https://www.linkedin.com/in/hadit1297/).


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
