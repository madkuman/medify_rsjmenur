FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
    libzip-dev unzip \
    libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo_mysql bcmath exif

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
