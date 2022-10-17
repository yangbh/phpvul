FROM php:8.0-fpm-buster
RUN sed -i "s@deb.debian.org@mirrors.aliyun.com@g" /etc/apt/sources.list \
    && sed -i "s@security.debian.org@mirrors.aliyun.com@g" /etc/apt/sources.list
# Install system dependencies
RUN apt-get update && apt-get install -y git libonig-dev

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring  mysqli \
 	&& docker-php-ext-enable pdo_mysql mysqli


# Set working directory
WORKDIR /var/www
