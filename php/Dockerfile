FROM php:8.2-apache

# Install mysqli the correct way
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable apache rewrite
RUN a2enmod rewrite

# Copy your app
COPY src/ /var/www/html/

# Permissions
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

EXPOSE 80