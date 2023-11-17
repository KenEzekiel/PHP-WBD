FROM php:8.0-apache

# (php mysql)
RUN rm -f /etc/apt/apt.conf.d/docker-clean \
    && apt-get update \
    && apt install libxml2-dev -y \
    && docker-php-ext-install soap

RUN docker-php-ext-install pdo pdo_mysql

COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html

COPY ./php.ini /usr/local/etc/php/php.ini
RUN a2enmod rewrite