FROM php:8.1.1-fpm
WORKDIR /var/www/html
RUN apt-get update && docker-php-ext-install pdo pdo_mysql


