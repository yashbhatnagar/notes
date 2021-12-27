FROM php:8.0.3-fpm-buster

# Set working directory
WORKDIR /var/www

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql \
  && docker-php-ext-configure zip \
  && docker-php-ext-install zip \
  && docker-php-ext-install mysqli mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy folders in order of least likely changes, to assist caching
COPY bootstrap /var/www/bootstrap
COPY resources /var/www/resources
COPY composer.* /var/www/
COPY artisan /var/www/
COPY server.php /var/www/
COPY public /var/www/public
COPY docker/.env.global /var/www/.env
COPY routes /var/www/routes
COPY storage /var/www/storage
COPY public /var/www/public
COPY database /var/www/database
COPY config /var/www/config
COPY app /var/www/app

# clear cache
RUN rm -rf /var/www/bootstrap/cache/*.php

# Set up application
RUN composer install --optimize-autoloader --no-interaction --no-progress;
RUN php artisan key:generate

# Expose port 9000 and start php-fpm server
EXPOSE 9000
