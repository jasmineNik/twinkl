FROM php:8.3-apache

# 1. Install development packages and clean up apt cache.
RUN apt-get update && apt-get install -y \
    curl \
    g++ \
    git \
    libbz2-dev \
    libzip-dev \
    libfreetype6-dev \
    libicu-dev \
    libjpeg-dev \
    libmcrypt-dev \
    libpng-dev \
    libreadline-dev \
    sudo \
    unzip \
    zip \
 && rm -rf /var/lib/apt/lists/*
RUN pecl install xdebug-3.3.1  \
    && docker-php-ext-enable xdebug
# 2. Apache configs + document root.
RUN echo "ServerName twinkl-app.local" >> /etc/apache2/apache2.conf

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 3. mod_rewrite for URL rewrite and mod_headers for .htaccess extra headers like Access-Control-Allow-Origin-
RUN a2enmod rewrite headers

# 4. Start with base PHP config, then add extensions.
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

RUN docker-php-ext-install  \
    mysqli \
    intl \
    gd \
    pdo_mysql \
    sockets \
    opcache \
    bcmath \
    zip

# 5. Composer.
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY . .
## 6. We need a user with the same UID/GID as the host user
## so when we execute CLI commands, all the host file's permissions and ownership remain intact.
## Otherwise commands from inside the container would create root-owned files and directories.
#ARG uid
#RUN useradd -G www-data,root -u $uid -d /home/hnikolyan@universe.dart.spb hnikolyan@universe.dart.spb
#RUN mkdir -p /home/hnikolyan@universe.dart.spb/.composer && \
#    chown -R hnikolyan@universe.dart.spb:hnikolyan@universe.dart.spb /home/hnikolyan@universe.dart.spb

RUN chown www-data:www-data storage -R
RUN chmod -R 777 storage
RUN composer install