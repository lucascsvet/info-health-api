FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libsqlite3-dev \
    libpq-dev \
    && docker-php-ext-install \
    pdo \
    pdo_mysql \
    pdo_sqlite \
    pdo_pgsql \
    mbstring \
    xml \
    zip \
    bcmath \
    opcache \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .
RUN composer install --no-dev --no-interaction --optimize-autoloader

EXPOSE 8000

CMD ["sh", "-c", "php artisan migrate --force && php artisan config:cache 2>/dev/null || true && php artisan serve --host=0.0.0.0 --port=${PORT:-8000}"]
