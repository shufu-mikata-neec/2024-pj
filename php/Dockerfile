FROM php:8.1-fpm

# MYSQL拡張のインストール
RUN docker-php-ext-install pdo pdo_mysql
# INSTALL git
RUN apt-get update && apt-get install -y git

WORKDIR /var/www/html