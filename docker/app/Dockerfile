FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    libzip-dev \
    nano \
    unzip \
    wget

RUN apt-get install -y libicu-dev \
&& docker-php-ext-configure intl \
&& docker-php-ext-install intl

RUN wget https://getcomposer.org/installer -O - -q | php -- --install-dir=/bin --filename=composer --quiet

WORKDIR /var/www
