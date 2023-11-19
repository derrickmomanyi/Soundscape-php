#!/usr/bin/env bash
echo "Running composer"
composer global require hirak/prestissimo
composer install --no-dev --working-dir=/var/www/html

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Running migrations..."
php artisan migrate --force

echo 'Starting database seeding'
php artisan db:seed
echo 'Completed database seeding'


# Testing
echo 'Starting tests'
composer test
echo 'Completed tests'

# Workers
echo 'Restarting queues'
php artisan queue:restart
echo 'Queue restarted'

echo 'Deployment completed. If any errors were encountered, consider rolling back the update immediately'