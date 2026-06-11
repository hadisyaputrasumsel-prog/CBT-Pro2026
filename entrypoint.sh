#!/bin/bash

echo "Running migrations and seeders..."
MAX_TRIES=30
COUNT=0
while [ $COUNT -lt $MAX_TRIES ]; do
    if php artisan migrate --force; then
        echo "Migrations successful!"
        break
    else
        echo "Migration failed, database might not be ready. Retrying in 2 seconds ($((COUNT+1))/$MAX_TRIES)..."
        sleep 2
        COUNT=$((COUNT+1))
    fi
done

php artisan db:seed --force || echo "Seeder failed or already seeded."

echo "Starting Apache..."
exec apache2-foreground
