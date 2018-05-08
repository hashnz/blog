FROM php:7.1-fpm

RUN sed -i 's/127.0.0.1:9000/0.0.0.0:9000/g' /usr/local/etc/php-fpm.d/www.conf
RUN echo 'memory_limit = 512M' > /usr/local/etc/php/php.ini

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
  && php composer-setup.php \
  && mv composer.phar /usr/local/bin/composer \
  && rm composer-setup.php

RUN apt-get update \
  && apt-get install -y \
     libfreetype6-dev \
     libjpeg62-turbo-dev \
     libicu-dev \
     apt-transport-https \
     ca-certificates \
     libmemcached-dev \
     memcached \
     git \
     libmcrypt-dev \
     zip \
     unzip

RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
  && docker-php-ext-configure opcache --enable-opcache \
  && pecl install xdebug \
  && docker-php-ext-enable xdebug \
  && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
  && echo "xdebug.idekey=PHPSTORM" >> /usr/local/etc/php/conf.d/xdebug.ini \
  && pecl install mongodb \
  && docker-php-ext-enable mongodb \
  && pecl install memcached \
  && docker-php-ext-enable memcached \
  && docker-php-ext-install \
    exif \
    gd \
    intl \
    pdo \
    pdo_mysql \
    opcache \
    mcrypt \
    zip \
    bcmath

WORKDIR /srv
