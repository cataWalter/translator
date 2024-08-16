# Use an official PHP image from the Docker Hub
FROM php:8.1-apache

# Set the working directory
WORKDIR /var/www/html

# Copy project files to the working directory
COPY . .

# Install Composer
RUN apt-get update && \
    apt-get install -y libzip-dev unzip && \
    docker-php-ext-install zip && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP dependencies
RUN composer install

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Expose port 80
EXPOSE 80