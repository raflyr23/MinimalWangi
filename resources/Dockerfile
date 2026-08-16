FROM php:8.2-apache

# 1. Install dependensi sistem yang dibutuhkan Laravel & PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    nodejs \
    npm \
    && docker-php-ext-install pdo pdo_pgsql pdo_mysql zip

# 2. Aktifkan mod_rewrite Apache
RUN a2enmod rewrite

# 3. Pindahkan lokasi kerja ke root folder Apache
WORKDIR /var/www/html

# 4. Salin seluruh file proyek ke dalam container
COPY . /var/www/html

# 5. Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# 6. Install NPM & Build Frontend (Vite)
RUN npm install
RUN npm run build

# 7. Atur hak akses folder agar Laravel bisa menulis cache
RUN chown -R www-data:www-data storage bootstrap/cache

# 8. Ubah Document Root Apache agar mengarah ke folder "public"
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# 9. Konfigurasi Port agar sesuai dengan sistem Render
RUN sed -i 's/Listen 80/Listen ${PORT}/g' /etc/apache2/ports.conf
RUN sed -i 's///g' /etc/apache2/sites-available/000-default.conf

# 10. Buat script yang mengeksekusi migrasi saat server menyala
RUN echo '#!/bin/bash\nphp artisan config:cache\nphp artisan route:cache\nphp artisan view:cache\nphp artisan migrate --force\napache2-foreground' > /start.sh
RUN chmod +x /start.sh

CMD ["/start.sh"]