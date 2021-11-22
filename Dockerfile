FROM php:8.0.12-apache

RUN docker-php-ext-install pdo_mysql
RUN a2enmod rewrite

RUN echo "ServerName 127.0.0.1" >> "/etc/apache2/apache2.conf"

ADD . /var/www
ADD ./public /var/www/html

RUN addgroup dockerusers
RUN useradd -G dockerusers -u 9872 -s /bin/bash dockeruserone

RUN chown -R dockeruserone /var/www
USER dockeruserone
RUN chmod 777 /var/www

WORKDIR /var/www