FROM php:fpm-alpine

RUN apk update

RUN apk add \
    icu-dev \
    postgresql-dev \
    libmcrypt-dev \
    libxml2-dev

RUN docker-php-ext-install \
    intl \
    opcache \
    pdo pdo_mysql mysqli \
    pgsql pdo_pgsql \
    mcrypt \
    mbstring \
    xml xmlrpc\
    zip

# Available ext-names
# bcmath bz2 calendar ctype curl dba dom enchant exif fileinfo filter ftp gd gettext gmp hash
# iconv imap interbase intl json ldap mbstring mcrypt mysqli oci8 odbc opcache pcntl pdo pdo_dblib
# pdo_firebird pdo_mysql pdo_oci pdo_odbc pdo_pgsql pdo_sqlite pgsql phar posix pspell readline
# recode reflection session shmop simplexml snmp soap sockets spl standard sysvmsg sysvsem sysvshm
# tidy tokenizer wddx xml xmlreader xmlrpc xmlwriter xsl zip

# Memcached must be a trick
# @see https://stackoverflow.com/questions/40894385/how-can-i-install-the-php-memcached-extension-on-dockers-php7-alpine-image
ENV MEMCACHED_DEPS zlib-dev libmemcached-dev cyrus-sasl-dev
RUN apk add --no-cache --update libmemcached-libs zlib
RUN set -xe \
    && apk add --no-cache --update --virtual .phpize-deps $PHPIZE_DEPS \
    && apk add --no-cache --update --virtual .memcached-deps $MEMCACHED_DEPS \
    && pecl install memcached \
    && echo "extension=memcached.so" > /usr/local/etc/php/conf.d/20_memcached.ini \
    && rm -rf /usr/share/php7 \
    && rm -rf /tmp/* \
    && apk del .memcached-deps .phpize-deps

# Another trick for GD
# @see https://github.com/docker-library/php/issues/225
RUN apk add freetype libpng libjpeg-turbo freetype-dev libpng-dev libjpeg-turbo-dev
RUN docker-php-ext-configure gd \
    --with-freetype-dir=/usr/include/ \
    --with-png-dir=/usr/include/ \
    --with-jpeg-dir=/usr/include/ && \
  NPROC=$(getconf _NPROCESSORS_ONLN) && \
  docker-php-ext-install -j${NPROC} gd && \
  apk del freetype-dev libpng-dev libjpeg-turbo-dev

# Imagemagick here
# @see https://github.com/m2sh/php7/blob/master/alpine/Dockerfile
RUN apk add --update --no-cache autoconf g++ imagemagick-dev libtool make pcre-dev \
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    && apk del autoconf g++ libtool make pcre-dev

COPY php.ini* /usr/local/etc/php/

WORKDIR /var/www

CMD ["php-fpm"]

EXPOSE 9000