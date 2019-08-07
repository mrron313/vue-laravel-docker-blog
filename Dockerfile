ARG NODE_VERSION=10.15
ARG COMPOSER_VERSION=1.8
ARG PHP_VERSION=7.2

#
# Frontend
#
FROM node:${NODE_VERSION}-alpine as frontend

# Install dependencies
RUN apk update --no-cache && \
    apk upgrade --no-cache && \
    apk add --no-cache \
    make \
    autoconf \
    automake \
    g++ \
    bash \
    libc6-compat \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev && \
    rm -rf /var/cache/apk/* && \
    mkdir -p /app/public

COPY package.json webpack.mix.js package-lock.json /app/

WORKDIR /app

RUN npm install

#
# PHP Dependencies
#
FROM composer:${COMPOSER_VERSION} as vendor

COPY database/ database/

COPY composer.json composer.json
COPY composer.lock composer.lock

RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

#
# PHP
#
FROM php:${PHP_VERSION}-fpm-alpine

LABEL maintainer="Arif Ul Islam <arifulislam@bs-23.net>"

ARG GID=1000
ARG UID=1000
ARG DEV=false

# Install dependencies
RUN apk update --no-cache && \
    apk upgrade --no-cache && \
    apk add --no-cache \
    libjpeg-turbo-dev \
    freetype-dev \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    bash && \
    rm -rf /var/cache/apk/*

# Install extensions
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl && \
    docker-php-ext-configure gd --with-gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/ && \
    docker-php-ext-install gd

COPY ./docker/php/conf.d/local.ini /usr/local/etc/php/conf.d/local.ini

RUN if [ ${DEV} = true ]; then \
  # Install the xdebug extension
  apk add --no-cache --update --virtual buildDeps autoconf g++ make && \
  pecl install xdebug && \
  docker-php-ext-enable xdebug && \
  apk del buildDeps && \
  rm -rf /var/cache/apk/* && \
  # show errors in development
  echo "error_reporting = E_ALL" >> /usr/local/etc/php/conf.d/local.ini && \
  echo "display_startup_errors = On" >> /usr/local/etc/php/conf.d/local.ini && \
  echo "display_errors = On" >> /usr/local/etc/php/conf.d/local.ini && \
  # Xdebug storage
  mkdir /tmp/xdebug && \
  chmod 777 /tmp/xdebug && \
  touch /tmp/xdebug/remote.log \
;fi

# Add user for laravel application
RUN addgroup -g ${GID} -S www && \
    adduser -u ${UID} -S -s /bin/sh -G www www

WORKDIR /var/www

# Copy app files
COPY --chown=www:www --from=vendor /app/vendor/ ./vendor/
COPY --chown=www:www --from=frontend /app/public/js/ ./public/js/
COPY --chown=www:www --from=frontend /app/public/css/ ./public/css/
COPY --chown=www:www --from=frontend /app/mix-manifest.json ./mix-manifest.json

# Copy existing application directory contents with permissions
COPY --chown=www:www . .

# Change current user to www
USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
