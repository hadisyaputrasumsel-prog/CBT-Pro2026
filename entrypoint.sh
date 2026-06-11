#!/bin/bash
set -e

# Run migrations and seed the database
echo "Running migrations and seeders..."
php artisan migrate --force
php artisan db:seed --force

# Start Apache in the foreground
echo "Starting Apache..."
exec apache2-foreground
