@echo off
REM Deployment Script untuk Backoffice Haircut (Windows)
REM Author: Development Team
REM Date: August 3, 2025

echo 🚀 Starting deployment for Backoffice Haircut...

REM 1. Pull latest changes
echo 📥 Pulling latest changes from repository...
git pull origin main

REM 2. Install/Update Composer dependencies
echo 📦 Installing/Updating Composer dependencies...
composer install --no-dev --optimize-autoloader

REM 3. Install/Update NPM dependencies  
echo 🔧 Installing/Updating NPM dependencies...
npm ci

REM 4. Clear caches
echo 🧹 Clearing application caches...
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

REM 5. Run database migrations
echo 💾 Running database migrations...
php artisan migrate --force

REM 6. Cache configurations for production
echo ⚡ Caching configurations for production...
php artisan config:cache
php artisan route:cache
php artisan view:cache

REM 7. Build production assets
echo 🎨 Building production assets...
npm run build

REM 8. Run cleanup commands
echo 🧽 Running cleanup commands...
php artisan app:cleanup-expired-codes

echo ✅ Deployment completed successfully!
echo 🌐 Application is now live!

pause
