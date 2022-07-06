
## Pre requisite

- composer
- PHP Version 7.3
- server for php (Laragon is fast way)
- Mysql
- node
- npm / yarn

## Install
- git clone
- change .env.example to .env or create .env file and copy the content inside
- create database and configure your section DB_
- change your APP_URL depending on your server
    > composer install

    > php artisan key:generate

    > php artisan migrate

    > php artisan passport:install

    > php artisan db:seed

    > npm install / yarn

    > npm run dev / yarn dev

    > php artisan serve ( [http://localhost:8000](http://localhost:8000) )
    
- if using laragon you need to change APP_URL depending on the host created by it and you can directly access from this URL

- intall maildev for track mailing functionnality
    > npm install -g maildev
    
    > maildev

## Login
    email: superadmin@gmail.com
    password: superadmin

## Testing
    > php artisan test





