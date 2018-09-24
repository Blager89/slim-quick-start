FROM php:7.2.8-apache
RUN apt-get update
RUN apt-get install -y libpq-dev wget
RUN docker-php-ext-install mysqli pdo pdo_mysql
WORKDIR /var/www/html
RUN wget -O adminer.php https://github.com/vrana/adminer/releases/download/v4.6.2/adminer-4.6.2.php
EXPOSE 80