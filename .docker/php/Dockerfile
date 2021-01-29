FROM php:8.0-fpm

RUN apt update && apt upgrade && apt install -y git unzip zip wget libpq-dev && docker-php-ext-install pdo pdo_pgsql
RUN wget https://get.symfony.com/cli/installer -O - | bash

COPY --from=composer:2.0 /usr/bin/composer /usr/bin/composer
