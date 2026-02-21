FROM php:8.2-apache

# Enable Apache rewrite
RUN a2enmod rewrite

# Copy app
COPY src/ /var/www/html/

# Fix permissions (THIS solves Forbidden error)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

EXPOSE 80