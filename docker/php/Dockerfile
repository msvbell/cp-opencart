FROM php:5.6-fpm

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/

RUN install-php-extensions gd mbstring mcrypt mysqli xdebug