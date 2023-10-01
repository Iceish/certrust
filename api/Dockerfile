FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/html/

# Install dependencies for the operating system software
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    zip \
    vim \
    git \
    curl

# Install extensions for php
RUN docker-php-ext-install pdo_mysql && \
    docker-php-ext-install gd

# Install composer (php package manager)
COPY --from=composer/composer:latest-bin /composer /usr/bin/composer

# Copy existing application directory contents to the working directory
COPY . /var/www/html
COPY .env.production /var/www/html/.env

# Install composer dependencies
RUN composer install --no-interaction --no-dev --prefer-dist --optimize-autoloader

# Assign permissions of the working directory to the www-data user
RUN chown -R www-data:www-data \
    /var/www/html/storage \
    /var/www/html/bootstrap/cache \
    && chmod +x /var/www/html/certrust-cli.sh

# Expose port 9000 and start php-fpm server (for FastCGI Process Manager)
EXPOSE 9000
CMD ["php-fpm"]
