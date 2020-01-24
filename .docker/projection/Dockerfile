FROM php:7.4-fpm

RUN docker-php-ext-install pdo_mysql

RUN pecl install apcu

RUN apt-get update && \
apt-get install -y \
libzip-dev \
zip

RUN docker-php-ext-install zip
RUN docker-php-ext-enable apcu

WORKDIR /usr/src/app

COPY . /usr/src/app
COPY .env /usr/src/app

RUN chmod +x bin/console; sync