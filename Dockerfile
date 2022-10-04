FROM php:8.1.1-fpm
WORKDIR /var/www/html
RUN  docker-php-ext-install pdo pdo_mysql
RUN  apt-get update -y && apt-get install -y libmariadb-dev