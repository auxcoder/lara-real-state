#!/bin/bash

# Laravel Real Estate - Zero-Downtime Deployment
# Uses symlinks for instant switching between releases
# Usage: ./deploy-zero-downtime.sh

set -e

PROJECT_NAME="laravel-real_state"
DEPLOY_PATH="/var/www/$PROJECT_NAME"
REPO_URL="git@github.com:yourusername/$PROJECT_NAME.git"
BRANCH="main"
KEEP_RELEASES=3

echo "🚀 Zero-Downtime Deployment"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

# Create directory structure
mkdir -p $DEPLOY_PATH/{releases,shared/{storage,uploads}}
mkdir -p $DEPLOY_PATH/shared/storage/{app,framework,logs}
mkdir -p $DEPLOY_PATH/shared/storage/framework/{cache,sessions,views}

# Generate release name
RELEASE=$(date +%Y%m%d%H%M%S)
RELEASE_PATH="$DEPLOY_PATH/releases/$RELEASE"

echo "📦 Creating release: $RELEASE"
mkdir -p $RELEASE_PATH

# Clone repository
echo "📥 Cloning repository..."
git clone --depth 1 --branch $BRANCH $REPO_URL $RELEASE_PATH

cd $RELEASE_PATH

# Copy .env from shared
echo "⚙️  Linking configuration..."
ln -nfs $DEPLOY_PATH/shared/.env .env

# Link storage
echo "🔗 Linking storage..."
rm -rf storage
ln -nfs $DEPLOY_PATH/shared/storage storage

# Link uploads
ln -nfs $DEPLOY_PATH/shared/uploads public/uploads

# Install dependencies
echo "📦 Installing dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

# Build assets
echo "🎨 Building assets..."
npm ci --production
npm run build

# Run migrations
echo "🗄️  Running migrations..."
php artisan migrate --force

# Optimize
echo "⚡ Optimizing..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Switch symlink (atomic operation)
echo "🔄 Switching to new release..."
ln -nfs $RELEASE_PATH $DEPLOY_PATH/current_tmp
mv -Tf $DEPLOY_PATH/current_tmp $DEPLOY_PATH/current

# Reload PHP-FPM
echo "🔄 Reloading PHP-FPM..."
sudo systemctl reload php8.1-fpm

# Cleanup old releases
echo "🧹 Cleaning up old releases..."
cd $DEPLOY_PATH/releases
ls -t | tail -n +$((KEEP_RELEASES + 1)) | xargs -r rm -rf

echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "✅ Deployment complete!"
echo "📍 Current release: $RELEASE"
echo "🔗 Symlink: $DEPLOY_PATH/current -> $RELEASE_PATH"
echo ""
echo "🔙 To rollback:"
echo "   cd $DEPLOY_PATH/releases"
echo "   ls -t  # Find previous release"
echo "   ln -nfs $DEPLOY_PATH/releases/PREVIOUS_RELEASE $DEPLOY_PATH/current"
echo "   sudo systemctl reload php8.1-fpm"
