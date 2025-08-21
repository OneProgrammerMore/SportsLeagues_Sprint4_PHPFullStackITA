#!/bin/bash
cd /var/www/html/
a2enmod rewrite
composer update && composer install 

php artisan key:generate
npm install

npm run build

php artisan cache:clear
php artisan view:clear
php artisan view:cache 

echo "Cup Laravel build and config finished successfully"