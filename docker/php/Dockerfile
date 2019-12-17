FROM php:5.6-fpm-alpine
RUN apk --no-cache add pcre-dev ${PHPIZE_DEPS} \
    freetype-dev libpng-dev libjpeg-turbo-dev libmcrypt-dev && \
        docker-php-ext-configure gd \
            --with-freetype-dir=/usr/include/ \
            --with-png-dir=/usr/include/ \
            --with-jpeg-dir=/usr/include/ \
    && pecl install xdebug-2.5.5 \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd mysqli \
    && apk del pcre-dev ${PHPIZE_DEPS}