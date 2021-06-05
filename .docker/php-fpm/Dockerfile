FROM php:7.2-fpm

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        supervisor \
        libpq-dev \
    && docker-php-ext-install -j$(nproc) iconv \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install -j$(nproc) gd

RUN pecl install redis-4.0.1 \
    && pecl install xdebug-2.6.0 \
    && docker-php-ext-enable redis xdebug \
    && docker-php-ext-install mysqli pdo pdo_mysql pdo_pgsql

# Cron
RUN apt-get update && apt-get install -y cron \
        rsyslog \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

COPY cron/cron.d /etc/cron.d
COPY cron/bin /cron/bin
RUN chmod 0700 /etc/cron.d/script
RUN chown -R root /cron/bin
RUN chmod 0700 -R /cron/bin