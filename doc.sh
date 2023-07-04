#### RUN PROJECT
Run 'composer update' from the projects root folder
From the projects root folder run 'php artisan key:generate'
From the projects root folder run 'php artisan migrate'


### COMMAND 
php artisan make:migrattion table_users --create=users
php artisan make:controller AuthController
php artisan make:model User
php artisan make:seeder UserSeeder

php artisan db:seed

php artisan config:cache 
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

php artisan optimize:clear

composer dump-autoload

php -S 127.0.0.1:8000 -t public/