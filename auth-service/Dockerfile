FROM alpine/git:v2.32.0 as wait
ADD https://github.com/ufoscout/docker-compose-wait/releases/download/2.8.0/wait /wait


FROM php:8.0.13-alpine

ARG DEBUG='false'
ARG RUN_DEPS='postgresql-libs'
ARG BUILD_DEPS='postgresql-dev'
ARG PHP_EXTENSIONS='sockets pcntl pdo_pgsql'

# Validate args
RUN if [ $DEBUG != 'true' && $DEBUG != 'false' ]; then echo 'DEBUG argument must be `true` or `false`!'; exit 1; fi

# Preparing system
RUN echo 'UTC' > /etc/timezone
COPY --from=wait /wait /.
RUN chmod +x /wait
RUN apk add --no-cache --virtual .build-deps $BUILD_DEPS \
    && docker-php-ext-install -j "$(nproc)" $PHP_EXTENSIONS \
    && apk del .build-deps
RUN apk add --no-cache --virtual .run-deps $RUN_DEPS
COPY --from=composer /usr/bin/composer /usr/bin/composer
WORKDIR /app

CMD /wait && composer install --no-interaction --no-progress --no-autoloader --no-cache \
#    && composer dump-autoload \
    && php artisan migrate --force && php artisan cache:clear \
    && php artisan egal:run

