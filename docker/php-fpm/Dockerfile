FROM php:8.2-fpm-alpine

RUN apk add --no-cache curl libpq-dev libzip-dev unzip

RUN docker-php-ext-install pdo pdo_pgsql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /srv
COPY . /srv