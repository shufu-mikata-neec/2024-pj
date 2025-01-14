FROM php:8.1-fpm

# MYSQL拡張のインストール
RUN docker-php-ext-install pdo pdo_mysql
# INSTALL git
RUN apt-get update && apt-get install -y git
# 手荒だが、uid=1000,gid=1000のユーザーを作成
RUN useradd -m -u 1000 -s /bin/bash app

WORKDIR /var/www/html