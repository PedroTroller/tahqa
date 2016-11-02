FROM php:7.0-apache

ARG COMPOSER_HOME=/root/.composer
ARG SYMFONY_ENV=prod
ARG SYMFONY_DEBUG=0

ENV SYMFONY_ENV=dev
ENV SYMFONY_DEBUG=1

RUN apt-get update \
    && apt-get install -y zlib1g-dev \
    && rm -rf /var/lib/apt/lists/*

COPY app/config/php.ini /usr/local/etc/php/

RUN docker-php-ext-install zip

WORKDIR /var/www

COPY ./app/App*.php ./app/
COPY ./composer.*   ./

RUN php -r "readfile('https://getcomposer.org/installer');" | php -- --install-dir=/usr/local/bin --filename=composer \
    && chmod +x /usr/local/bin/composer \
    && composer global require hirak/prestissimo --prefer-source \
    && composer install --optimize-autoloader --no-scripts --prefer-source \
    && rm -rf /usr/local/bin/composer $COMPOSER_HOME -rf

COPY ./app         ./app
COPY ./src         ./src
COPY ./bin/console ./bin/console
