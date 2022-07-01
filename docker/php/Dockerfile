FROM php:8.0.1-fpm

# Install mcrypt for development
RUN apt-get update && apt-get install -y libmcrypt-dev \
    && pecl install mcrypt-1.0.4 \
    && docker-php-ext-enable mcrypt

# Install pdo_mysql
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Install pdo_postgres
RUN apt-get update && \
    apt-get install -y libpq-dev && \
    docker-php-ext-install pdo pdo_pgsql pgsql

# Install xdebug for development
RUN    pecl install xdebug \
    && docker-php-ext-enable xdebug

# Install composer
RUN curl --silent --show-error https://getcomposer.org/installer | php
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/php

EXPOSE 9000