FROM php:8.0-fpm-alpine

WORKDIR /app

RUN apk --update upgrade

RUN docker-php-ext-install pdo pdo_mysql

COPY etc/php/ /usr/local/etc/php/
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
