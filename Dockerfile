# ==========================================
# Multi-stage build Laravel + FrankenPHP PHP 8.3
# ==========================================
FROM composer:2.8 AS vendor
WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist \
    --no-dev

COPY . .
RUN composer dump-autoload --optimize --no-dev --no-scripts

# Frontend build
FROM node:20-alpine AS frontend
WORKDIR /app
COPY package.json package-lock.json* ./
RUN npm install
COPY . .
RUN npm run build

# Production runtime image with PHP 8.3 & FrankenPHP
FROM dunglas/frankenphp:1-php8.3-bookworm AS runner

ENV APP_ENV=production
ENV APP_DEBUG=false
ENV LOG_CHANNEL=stderr
ENV VIEW_COMPILED_PATH=/tmp/views
ENV APP_CONFIG_CACHE=/tmp/config.php
ENV APP_EVENTS_CACHE=/tmp/events.php
ENV APP_PACKAGES_CACHE=/tmp/packages.php
ENV APP_ROUTES_CACHE=/tmp/routes.php
ENV APP_SERVICES_CACHE=/tmp/services.php

WORKDIR /app

# Copy application source code & dependencies
COPY --from=vendor /app /app
COPY --from=frontend /app/public/build /app/public/build

# Copy runtime entrypoint & Caddy config
COPY Caddyfile /etc/caddy/Caddyfile
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Run package discover inside the runner stage where all PHP extensions are present
RUN php artisan package:discover --ansi || true

# Ensure storage directories exist and are writable
RUN mkdir -p \
    /app/storage/framework/sessions \
    /app/storage/framework/views \
    /app/storage/framework/cache \
    /app/storage/logs \
    /app/bootstrap/cache \
    && chmod -R 777 /app/storage /app/bootstrap/cache

EXPOSE 8080

ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
CMD ["frankenphp", "run", "--config", "/etc/caddy/Caddyfile"]

