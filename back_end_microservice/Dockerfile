# Use an official PHP runtime as a parent image
FROM php:8.0.2-apache

# Set the working directory in the container
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install zip

# Install MongoDB PHP extension
RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

# Enable Apache modules
RUN a2enmod rewrite

# Copy composer files and install dependencies
COPY composer.* ./
COPY composer.phar /usr/local/bin/composer
RUN chmod +x /usr/local/bin/composer

# Update PATH environment variable
ENV PATH="$PATH:/usr/local/bin"

# Install Composer dependencies
RUN composer install --prefer-dist --no-dev --no-scripts --no-progress --no-interaction

# Copy the rest of the application code
COPY . .

# Create storage and bootstrap/cache directories if they don't exist
RUN mkdir -p storage bootstrap/cache

# Set permissions for Laravel storage and bootstrap folders
RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

# Copy Apache virtual host file
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

# Enable the virtual host file
RUN a2ensite 000-default

# Expose port 80 to the Docker host, so we can access it from the outside
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]