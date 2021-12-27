FROM php:8.0.3-fpm-buster

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

RUN docker-php-ext-install pdo_mysql \
  && docker-php-ext-configure zip \
  && docker-php-ext-install zip \
  && docker-php-ext-install mysqli

# composer install early for caching
# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# The app and related resources that dont change as often
COPY --chown=www:www public /var/www/public

# Add user for application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www
RUN chown -R www:www /var/www

# Run php-fpm on 9001 to avoid collisions with api
RUN sed -i 's/9000/9001/' /usr/local/etc/php-fpm.d/zz-docker.conf

USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9001
CMD ["php-fpm"]
