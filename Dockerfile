FROM php:7.4-fpm-bullseye
RUN cp /etc/apt/sources.list /etc/apt/sources.list.bak
RUN sed -i "s@deb.debian.org@mirrors.aliyun.com@g" /etc/apt/sources.list \
    && sed -i "s@security.debian.org@mirrors.aliyun.com@g" /etc/apt/sources.list
# Install system dependencies
RUN apt-get update && apt-get install -y git libonig-dev

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring  mysqli \
 	&& docker-php-ext-enable pdo_mysql mysqli 


# install php agent for DongTai IAST
# install dev for dongtai extension
# no GLIBCXX_3.4.26
# strings /usr/lib/x86_64-linux-gnu/libstdc++.so.6 | grep GLIBCXX
# RUN apt install -y software-properties-common gnupg && \
#     apt install -y --reinstall ca-certificates && \
#     add-apt-repository ppa:ubuntu-toolchain-r/test && \
#     apt update && \
#     apt install -y gcc-9 && \
#     apt install -y libstdc++6 

# RUN apt install -y vim 

SHELL ["/bin/bash", "-c"]

COPY php-agent.tar.gz /tmp/php-agent.tar.gz
COPY .env .
RUN source .env && \
    cd /tmp && \
    tar -zxvf /tmp/php-agent.tar.gz && \
    mv /tmp/php-agent/dongtai_php_agent.so /usr/local/lib/php/extensions/no-debug-non-zts-20190902/ && \
    sed -i "s/home\/vagrant/tmp/" /tmp/php-agent/dongtai-php-property.ini && \
    sed -i "s/mydev/${DongTai_Server}/" /tmp/php-agent/dongtai-php-property.ini && \
    sed -i "s/76826a0ec74a23daf8dda4ad4c44eb68adba0a53/${DongTai_Token}/" /tmp/php-agent/dongtai-php-property.ini && \
    mv /tmp/php-agent/dongtai-php-property.ini /usr/local/etc/php/conf.d/


# Set working directory
WORKDIR /var/www
