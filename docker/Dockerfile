FROM php:8.5-cli-alpine

RUN echo 'memory_limit = 512M' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini;

COPY --from=mlocati/php-extension-installer:2.7 /usr/bin/install-php-extensions /usr/local/bin/

RUN apk add --no-cache autoconf g++ make && \
    install-php-extensions \
      pcov \
      pdo_sqlite

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/

COPY ../ /app

WORKDIR /app
