FROM php:8.2-apache

# Install system libs required for mysqli
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    default-mysql-client \
    && docker-php-ext-install mysqli \
    && apt-get clean

# Enable apache rewrite
RUN a2enmod rewrite

# Allow apache to serve folder
RUN sed -i 's|/var/www/|/var/www/html|g' /etc/apache2/apache2.conf && \
    sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# Copy site
COPY src/ /var/www/html/

# Permissions
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

EXPOSE 80