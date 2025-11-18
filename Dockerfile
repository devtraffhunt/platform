FROM php:7.4-fpm

# 1. Системные зависимости
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libzip-dev \
    zip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring zip gd

# 2. Установка Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 3. Рабочая директория
WORKDIR /var/www

# 4. Копируем файлы проекта
COPY . .

# 5. Установка зависимостей Laravel
RUN composer install --no-dev --optimize-autoloader

# 6. Права на storage и cache
RUN chown -R www-data:www-data storage bootstrap/cache

# 7. Запуск php-fpm (логи Laravel идут в stdout)
CMD ["php-fpm"]

EXPOSE 9000
