FROM richarvey/nginx-php-fpm:3.1.6

RUN sed -i \
    -e "s/;memory_limit\s*=\s*128M/memory_limit = 512M/g" \
    ${php_vars}

COPY . .

# Image config
ENV SKIP_COMPOSER=1
ENV WEBROOT=/var/www/html/public
ENV PHP_ERRORS_STDERR=1
ENV RUN_SCRIPTS=1
ENV REAL_IP_HEADER=1
ENV PHP_MEM_LIMIT=1024

# Laravel config
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV LOG_CHANNEL=stderr

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER=1

RUN mkdir -p /etc/supervisor/conf.d
ADD conf/laravel-worker.conf /etc/supervisor/conf.d

CMD ["/start.sh"]
