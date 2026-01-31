#!/bin/bash

# Laravel Real Estate - Quick Rollback Script
# Usage: ./rollback.sh [steps]
# Example: ./rollback.sh 1  (rollback 1 commit)

set -e

STEPS=${1:-1}

echo "⏪ Rolling back $STEPS commit(s)..."
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

# Confirm
read -p "⚠️  Are you sure you want to rollback? (yes/no): " confirm
if [ "$confirm" != "yes" ]; then
    echo "❌ Rollback cancelled"
    exit 0
fi

# Enable maintenance mode
echo "🔧 Enabling maintenance mode..."
php artisan down

# Backup current state
echo "💾 Creating backup..."
BACKUP_DIR="backups/rollback_$(date +%Y%m%d_%H%M%S)"
mkdir -p $BACKUP_DIR
cp .env $BACKUP_DIR/
mysqldump -u $(grep DB_USERNAME .env | cut -d '=' -f2) \
          -p$(grep DB_PASSWORD .env | cut -d '=' -f2) \
          $(grep DB_DATABASE .env | cut -d '=' -f2) > $BACKUP_DIR/database.sql

# Rollback code
echo "🔄 Rolling back code..."
git reset --hard HEAD~$STEPS

# Reinstall dependencies
echo "📦 Reinstalling dependencies..."
composer install --no-dev --optimize-autoloader

# Rollback migrations (if needed)
read -p "🗄️  Rollback database migrations? (yes/no): " rollback_db
if [ "$rollback_db" = "yes" ]; then
    php artisan migrate:rollback --step=$STEPS --force
fi

# Clear caches
echo "🧹 Clearing caches..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Rebuild caches
echo "⚡ Rebuilding caches..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Rebuild assets
echo "🎨 Rebuilding assets..."
npm run build

# Disable maintenance mode
echo "✅ Disabling maintenance mode..."
php artisan up

echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "✅ Rollback complete!"
echo "💾 Backup saved to: $BACKUP_DIR"
echo ""
echo "🔍 Verify the application:"
echo "   • Test homepage"
echo "   • Check logs: tail -f storage/logs/laravel.log"
echo "   • Test critical features"
