# Use official PHP image with GD extension
FROM php:8.1-apache

# Install system dependencies for GD
RUN apt-get update && \
    apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev zlib1g-dev && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd

COPY . /var/www/html/
WORKDIR /var/www/html

# Set document root to public
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Create the generated directory and set permissions
RUN mkdir -p /var/www/html/public/generated && chmod -R 777 /var/www/html/public/generated

EXPOSE 80
CMD ["apache2-foreground"] 