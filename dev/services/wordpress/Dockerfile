FROM php:7.4-fpm

ARG PUID
ARG PGID

# Set Timezone

RUN ln -snf /usr/share/zoneinfo/CET /etc/localtime && echo CET > /etc/timezone

# Install Dependencies

RUN set -ex; \
    apt-get update; \
    apt-get install -y --no-install-recommends \
        default-mysql-client \
        git \
        less \
        libmagickwand-dev \
        libsodium-dev \
        libzip-dev \
        locales-all \
        msmtp \
        unzip; \
    docker-php-ext-install \
        exif \
        mysqli \
        opcache \
        soap \
        zip; \
    pecl install \
        imagick \
        xdebug; \
    docker-php-ext-enable \
        imagick;

# Install Composer

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Configure MailHog

COPY msmtprc /etc/msmtprc

# Copy files

RUN cp $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini
COPY user.ini $PHP_INI_DIR/conf.d/
COPY user-fpm.conf $PHP_INI_DIR/../php-fpm.d/user.conf
COPY enable-xdebug.sh /usr/local/bin
COPY disable-xdebug.sh /usr/local/bin

# Setup the user

RUN usermod -u ${PUID} www-data
RUN groupmod -g ${PGID} www-data
RUN mkhomedir_helper www-data
RUN chown -R www-data:www-data /var/www

# Done

WORKDIR /srv/app
CMD su www-data --shell /bin/sh --command "composer install" && php-fpm
