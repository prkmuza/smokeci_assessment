# Use the official PHP 8.0 Apache base image
FROM php:8.0-apache

# Set the working directory inside the container
WORKDIR /var/www/html

# Copy the current directory contents into the container at /var/www/html
COPY . /var/www/html

# Install additional PHP extensions if needed
# For example, if you need mysqli extension:
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Apache configuration: enable rewrite module
RUN a2enmod rewrite

# Expose port 8080 to the Docker host, so we can access the server
EXPOSE 8080

# Define the Apache server's document root
ENV APACHE_DOCUMENT_ROOT /var/www/html

# Configure Apache to use the document root specified above
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf

# Enable PHP error logging to STDOUT/STDERR
RUN ln -sf /dev/stderr /var/log/apache2/error.log

# Start Apache server
CMD ["apache2-foreground"]
