#!/bin/sh
set -e

# Pastikan folder writable oleh runtime container
mkdir -p /app/storage/framework/sessions \
         /app/storage/framework/views \
         /app/storage/framework/cache \
         /app/storage/logs \
         /app/bootstrap/cache \
         /app/database

touch /app/database/database.sqlite
chmod -R 777 /app/storage /app/bootstrap/cache /app/database 2>/dev/null || true

# Jalankan migrasi dan seeder bila belum ada
php artisan migrate --force --no-interaction || true
php artisan db:seed --force --no-interaction || true

# Pastikan storage symlink terpasang
php artisan storage:link 2>/dev/null || true

exec "$@"
