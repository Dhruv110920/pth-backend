FROM php:8.2-apache

# Enable Apache rewrite (optional but good)
RUN a2enmod rewrite

# Copy your PHP app into Apache web root
COPY src/ /var/www/html/

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80