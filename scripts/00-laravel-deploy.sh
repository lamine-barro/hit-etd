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

touch database/database.sqlite

# Install nvm
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.40.3/install.sh | bash

# Init nvm
\. "$HOME/.nvm/nvm.sh"

nvm install 22

echo "Build Assets"
npm i
npm run build
