FROM php:8.3-fpm-alpine

WORKDIR /var/www/app

COPY . ./

RUN apk add libpq-dev
RUN docker-php-ext-install pdo_pgsql
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install && composer update
