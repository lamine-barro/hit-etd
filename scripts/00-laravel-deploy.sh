#!/usr/bin/env bash
echo "Running composer"
composer install --no-dev --working-dir=/var/www/html

echo "Publish vendors"
php artisan vendor:publish --force --tag=livewire:assets

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Running migrations..."
php artisan migrate --force

echo "Seed master data..."
php artisan db:seed --force

# for avoid loading error
touch database/database.sqlite

echo "Build Assets"
npm i
npm run build

chmod -R 777 /var/www/html
chown -R www-data:nginx /var/www/html

php artisan storage:link

echo "Cron job added for Laravel scheduler"

crontab -l > laravel_cron
echo "* * * * * php /var/www/html/artisan schedule:run >> /dev/null 2>&1" >> laravel_cron
crontab laravel_cron
rm laravel_cron

echo "Laravel deploy completed"
