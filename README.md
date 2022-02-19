# Quality Manage System Project

Developed by **[HaNQ](https://www.facebook.com/elkun310/)**

## Environment
- Nginx: >= 1.16
- PHP: 7.4
- MySQL: 5.6
- Laravel Framework: 6.20.44

## Install guide

- Config Env and setup database:
    - `cp .env.example .env`
    - `php artisan key:generate`
    - `php artisan db:migrate`
    - `php artisan db:seed`
    - `php artisan storage:link`
