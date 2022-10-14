FROM php:8.0-fpm-buster
RUN sed -i "s@deb.debian.org@mirrors.aliyun.com@g" /etc/apt/sources.list \
    && sed -i "s@security.debian.org@mirrors.aliyun.com@g" /etc/apt/sources.list
# Install system dependencies
RUN apt-get update && apt-get install -y git libonig-dev

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring  mysqli \
 	&& docker-php-ext-enable pdo_mysql mysqli


# install php agent for DongTai IAST

RUN echo "DongTai_Server :${DongTai_Server}"
RUN echo "DongTai_Token :${DongTai_Token}"

SHELL ["/bin/bash", "-c"]

COPY php-agent.tar.gz /tmp/php-agent.tar.gz
COPY .env .
RUN source .env && \
    cd /tmp && \
    tar -zxvf /tmp/php-agent.tar.gz && \
    mv /tmp/php-agent/dongtai_php_agent.so /usr/local/lib/php/extensions/ && \
    sed -i "s/home\/vagrant/tmp/" /tmp/php-agent/dongtai-php-property.ini && \
    sed -i "s/mydev/${DongTai_Server}/" /tmp/php-agent/dongtai-php-property.ini && \
    sed -i "s/76826a0ec74a23daf8dda4ad4c44eb68adba0a53/${DongTai_Token}/" /tmp/php-agent/dongtai-php-property.ini 
    # mkdir /var/www/php-agent && \
    # cp /tmp/php-agent/dongtai-php-property.ini /var/www/php-agent/ && \
    # cp /tmp/php-agent/policy.json /var/www/php-agent/


# Set working directory
WORKDIR /var/www
