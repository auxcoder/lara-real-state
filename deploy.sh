#!/bin/bash

# Laravel Real Estate - Quick Deployment Script
# Usage: ./deploy.sh [environment]
# Example: ./deploy.sh production

set -e  # Exit on error

ENV=${1:-production}
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"

echo "🚀 Starting deployment for: $ENV"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

# Check if .env exists
if [ ! -f "$SCRIPT_DIR/.env" ]; then
    echo "❌ Error: .env file not found!"
    echo "   Copy .env.example to .env and configure it first."
    exit 1
fi

# 1. Enable maintenance mode
echo "🔧 Enabling maintenance mode..."
php artisan down || true

# 2. Pull latest code (if git repo)
if [ -d ".git" ]; then
    echo "📥 Pulling latest code..."
    git pull origin main
fi

# 3. Install/Update dependencies
echo "📦 Installing dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

# 4. Run migrations
echo "🗄️  Running database migrations..."
php artisan migrate --force

# 5. Clear old caches
echo "🧹 Clearing old caches..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# 6. Rebuild caches
echo "⚡ Building caches..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 7. Build frontend assets
if [ -f "package.json" ]; then
    echo "🎨 Building frontend assets..."
    npm install --production
    npm run build
fi

# 8. Storage link
echo "🔗 Creating storage link..."
php artisan storage:link || true

# 9. Set permissions
echo "🔐 Setting permissions..."
chmod -R 755 storage bootstrap/cache

# 10. Disable maintenance mode
echo "✅ Disabling maintenance mode..."
php artisan up

echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "🎉 Deployment complete!"
echo ""
echo "📋 Post-deployment checklist:"
echo "   • Test homepage: curl -I https://yourdomain.com"
echo "   • Check logs: tail -f storage/logs/laravel.log"
echo "   • Test admin login"
echo "   • Verify language switching"
echo ""
echo "🔄 To rollback: git reset --hard HEAD~1 && ./deploy.sh"
