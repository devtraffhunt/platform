# ---------- stage: vendor (ставим зависимости без скриптов artisan) ----------
FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-interaction --no-progress --no-scripts

# ---------- stage: runtime (FrankenPHP + PHP 8.3) ----------
FROM dunglas/frankenphp:1-php8.3 AS app
WORKDIR /app

# Если нужны доп. расширения PHP — раскомментируй строку ниже
# RUN install-php-extensions pcntl bcmath pdo_mysql pdo_pgsql redis

# Копируем исходники и готовую папку vendor из предыдущего стейджа
COPY . .
COPY --from=vendor /app/vendor ./vendor

# Права на кэш/сторейдж
RUN mkdir -p storage bootstrap/cache \
 && chown -R www-data:www-data storage bootstrap/cache \
 && chmod -R ug+rw storage bootstrap/cache

# Теперь artisan уже на месте — прогреем кэши (если что-то не критично — не валим билд)
RUN php artisan package:discover --ansi \
 && php artisan config:cache \
 && php artisan route:cache || true

# Настройки Octane + FrankenPHP
ENV OCTANE_SERVER=frankenphp \
    OCTANE_HTTP_HOST=0.0.0.0 \
    OCTANE_HTTP_PORT=8080

EXPOSE 8080

# Запуск сервера
CMD ["php","artisan","octane:start","--server=frankenphp","--host=0.0.0.0","--port=8080","--workers=4","--max-requests=500"]
