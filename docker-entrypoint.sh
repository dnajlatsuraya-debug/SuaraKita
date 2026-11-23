#!/bin/sh
set -e

mkdir -p /tmp/views /tmp/cache
chmod -R 777 /tmp/views /tmp/cache 2>/dev/null || true

# Auto-run migrations in production if database connection configured
if [ -n "$DB_HOST" ] || [ "$DB_CONNECTION" = "sqlite" ]; then
    echo "Running migrations..."
    php artisan migrate --force --no-interaction || true
fi

# Ensure storage link exists
php artisan storage:link 2>/dev/null || true

exec "$@"
