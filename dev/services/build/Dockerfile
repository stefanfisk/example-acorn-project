FROM php:7.4-cli

ARG PUID
ARG PGID

ENV NODE_ENV=development

# Set Timezone

RUN ln -snf /usr/share/zoneinfo/CET /etc/localtime && echo CET > /etc/timezone

# Install Dependencies

RUN set -ex; \
    apt-get update; \
    curl -sL https://deb.nodesource.com/setup_lts.x | bash -; \
    apt-get install -y --no-install-recommends \
        libxml2-dev \
        nodejs; \
    docker-php-ext-install \
        mysqli; \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Setup the user

RUN usermod -u ${PUID} www-data
RUN groupmod -g ${PGID} www-data
RUN mkhomedir_helper www-data
RUN chown -R www-data:www-data /var/www

# Done

USER www-data
WORKDIR /srv/app
CMD COLOR=1 npm install && FORCE_COLOR=1 exec npm run watch
