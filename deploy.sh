#!/bin/bash

# Deployment Script untuk Backoffice Haircut
# Author: Development Team
# Date: August 3, 2025

echo "🚀 Starting deployment for Backoffice Haircut..."

# 1. Pull latest changes
echo "📥 Pulling latest changes from repository..."
git pull origin main

# 2. Install/Update Composer dependencies
echo "📦 Installing/Updating Composer dependencies..."
composer install --no-dev --optimize-autoloader

# 3. Install/Update NPM dependencies
echo "🔧 Installing/Updating NPM dependencies..."
npm ci

# 4. Clear caches
echo "🧹 Clearing application caches..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# 5. Run database migrations
echo "💾 Running database migrations..."
php artisan migrate --force

# 6. Cache configurations for production
echo "⚡ Caching configurations for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 7. Build production assets
echo "🎨 Building production assets..."
npm run build

# 8. Set proper permissions
echo "🔐 Setting proper file permissions..."
chown -R www-data:www-data storage
chown -R www-data:www-data bootstrap/cache
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# 9. Restart services
echo "🔄 Restarting services..."
sudo systemctl restart nginx
sudo systemctl restart php8.2-fpm

# 10. Run cleanup commands
echo "🧽 Running cleanup commands..."
php artisan app:cleanup-expired-codes

echo "✅ Deployment completed successfully!"
echo "🌐 Application is now live!"

# Optional: Send notification
# curl -X POST "https://hooks.slack.com/YOUR/SLACK/WEBHOOK" \
#   -H 'Content-type: application/json' \
#   --data '{"text":"🚀 Backoffice Haircut deployed successfully!"}'
