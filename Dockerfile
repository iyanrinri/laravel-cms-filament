FROM php:8.4-fpm

WORKDIR /var/www

# Install dependencies dan ekstensi PHP yang diperlukan
RUN apt-get update && apt-get install -y \
    procps util-linux git unzip zip libpng-dev libjpeg-dev libfreetype6-dev libzip-dev \
    libicu-dev \
    && docker-php-ext-install pdo_mysql gd zip intl opcache

# Copy Composer dari image resmi
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy seluruh project ke dalam container
COPY . /var/www

# Copy konfigurasi PHP kustom
COPY docker/custom-php.ini /usr/local/etc/php/php.ini
COPY docker/www.conf /usr/local/etc/php-fpm.d/www.conf

RUN mkdir -p bootstrap/cache && chmod -R 775 bootstrap/cache
RUN [ -L public/storage ] && rm public/storage || true

# Install Node.js dan npm
#RUN apt update && apt install -y curl && \
#    curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
#    apt install -y nodejs
#
#RUN npm install -g npm \
#    && npm install -g pnpm \
#    && npm install -g pm2 yarn

RUN mkdir -p bootstrap/cache && chmod -R 775 bootstrap/cache
RUN [ -L public/storage ] && rm public/storage || true
    # Buat direktori storage dan isi default-nya
RUN mkdir -p storage/app/public \
    && mkdir -p storage/framework/cache \
    && mkdir -p storage/framework/sessions \
    && mkdir -p storage/framework/testing \
    && mkdir -p storage/framework/views \
    && mkdir -p storage/logs \
    && touch storage/app/.gitignore \
    && touch storage/app/public/.gitignore \
    && touch storage/framework/.gitignore \
    && touch storage/framework/cache/.gitignore \
    && touch storage/framework/sessions/.gitignore \
    && touch storage/framework/testing/.gitignore \
    && touch storage/framework/views/.gitignore \
    && touch storage/logs/.gitignore


# Install dependencies PHP dengan Composer
RUN composer install

EXPOSE 9000
CMD ["php-fpm"]
