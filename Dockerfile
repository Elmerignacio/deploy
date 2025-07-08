FROM php:8.2-apache

# Install PHP extensions
RUN apt-get update && apt-get install -y \
    libzip-dev unzip zip curl \
    && docker-php-ext-install zip pdo pdo_mysql

# Enable Apache rewrite module
RUN a2enmod rewrite

# Set working directory to Laravel root (not html!)
WORKDIR /var/www

# Copy entire Laravel app to container
COPY . .

# Set permissions
RUN chown -R www-data:www-data /var/www

# Change Apache DocumentRoot to point to Laravel's public folder
RUN sed -i 's|/var/www/html|/var/www/public|g' /etc/apache2/sites-available/000-default.conf

# Allow .htaccess and override rules for Laravel routing
RUN echo "<Directory /var/www/public>\nAllowOverride All\nRequire all granted\n</Directory>" >> /etc/apache2/apache2.conf
