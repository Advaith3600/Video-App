ENV PHP_OPCACHE_VALIDATE_TIMESTAMPS="0" \
    PHP_OPCACHE_MAX_ACCELERATED_FILES="10000" \
    PHP_OPCACHE_MEMORY_CONSUMPTION="192" \
    PHP_OPCACHE_MAX_WASTED_PERCENTAGE="10" \
    PHP_MEMORY_LIMIT="512M" \
    PHP_MAX_EXECUTION_TIME="60" \
    PHP_FPM_MAX_CHILDREN="100" \
    PHP_FPM_MAX_REQUESTS="1000" \
    PHP_FPM_PM="ondemand" \
    PHP_FPM_PROCESS_IDLE_TIMEOUT="10s"

RUN apk info \
    && echo @edge http://nl.alpinelinux.org/alpine/edge/community >> /etc/apk/repositories \
    && echo @edge http://nl.alpinelinux.org/alpine/edge/main >> /etc/apk/repositories \
    && apk update \
    && apk upgrade \
    && apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS \
    && apk add --no-cache \
        sudo \
        runit \
        nginx \
        zlib-dev \
        icu-dev \
        libzip-dev \
        libjpeg-turbo-dev \
        libpng-dev \
        libxml2-dev \
        freetype-dev \
        bash \
        git \
        nodejs \
        npm \
        composer \
        php8-tokenizer \
        php8-simplexml \
        php8-dom \
        mysql-client \
        mariadb-connector-c \
        yarn@edge \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        gd \
        pdo_mysql \
        zip \
        bcmath \
        exif \
        intl \
        opcache \
        pcntl \
        iconv \
    && pecl install \
        redis \
    && docker-php-ext-enable \
        redis \
    && apk del .build-deps \
    && rm -rf /tmp/* /var/cache/apk/* 

RUN apk add gnu-libiconv=1.15-r3 --update-cache --repository http://dl-cdn.alpinelinux.org/alpine/v3.13/community/ --allow-untrusted
ENV LD_PRELOAD /usr/lib/preloadable_libiconv.so

SHELL ["/bin/bash", "-c"]

RUN mkdir /opt/app
WORKDIR /opt/app

ADD https://github.com/vishnubob/wait-for-it/raw/master/wait-for-it.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/wait-for-it.sh

WORKDIR /var/www/html

COPY . .

CMD ["yarn", "run", "prod"]