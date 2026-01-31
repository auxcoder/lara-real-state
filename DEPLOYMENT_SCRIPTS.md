# Deployment Scripts

Quick deployment automation for Laravel Real Estate application.

## Available Scripts

### 1. `deploy.sh` - Standard Deployment
Simple deployment with maintenance mode.

**Usage:**
```bash
./deploy.sh
```

**What it does:**
- Enables maintenance mode
- Pulls latest code
- Installs dependencies
- Runs migrations
- Clears & rebuilds caches
- Builds frontend assets
- Disables maintenance mode

**Downtime:** ~30-60 seconds

---

### 2. `deploy-zero-downtime.sh` - Zero-Downtime Deployment
Advanced deployment using symlink switching.

**Usage:**
```bash
./deploy-zero-downtime.sh
```

**What it does:**
- Creates new release directory
- Clones code to new release
- Links shared storage & config
- Installs dependencies & builds assets
- Runs migrations
- Atomically switches symlink
- Keeps last 3 releases

**Downtime:** 0 seconds (instant switch)

**Setup Required:**
```bash
# First time setup
mkdir -p /var/www/laravel-real_state/shared
cp .env /var/www/laravel-real_state/shared/.env

# Update Nginx/Apache to point to:
# /var/www/laravel-real_state/current/public
```

---

### 3. `rollback.sh` - Quick Rollback
Rollback to previous version.

**Usage:**
```bash
# Rollback 1 commit
./rollback.sh 1

# Rollback 3 commits
./rollback.sh 3
```

**What it does:**
- Creates backup (code + database)
- Rolls back git commits
- Optionally rolls back migrations
- Reinstalls dependencies
- Rebuilds caches & assets

---

## Quick Start

### First Deployment

1. **Prepare server:**
```bash
# Install requirements
sudo apt update
sudo apt install php8.1 php8.1-fpm nginx mysql-server composer nodejs npm

# Clone repository
git clone <repo-url> /var/www/laravel-real_state
cd /var/www/laravel-real_state
```

2. **Configure environment:**
```bash
cp .env.example .env
nano .env  # Edit configuration
php artisan key:generate
```

3. **Set permissions:**
```bash
sudo chown -R www-data:www-data /var/www/laravel-real_state
chmod +x deploy.sh rollback.sh
```

4. **Deploy:**
```bash
./deploy.sh
```

5. **Seed permissions:**
```bash
php artisan db:seed --class=PermissionSeeder
```

---

### Subsequent Deployments

**Standard (with brief downtime):**
```bash
./deploy.sh
```

**Zero-downtime (production):**
```bash
./deploy-zero-downtime.sh
```

---

## Rollback Procedure

If deployment fails:

```bash
# Quick rollback
./rollback.sh 1

# Or manual rollback
git reset --hard HEAD~1
composer install --no-dev
php artisan migrate:rollback --step=1
php artisan cache:clear
npm run build
```

---

## Automation with CI/CD

### GitHub Actions Example

`.github/workflows/deploy.yml`:
```yaml
name: Deploy

on:
  push:
    branches: [ main ]

jobs:
  deploy:
    runs-on: ubuntu-latest
    steps:
      - name: Deploy to production
        uses: appleboy/ssh-action@master
        with:
          host: ${{ secrets.HOST }}
          username: ${{ secrets.USERNAME }}
          key: ${{ secrets.SSH_KEY }}
          script: |
            cd /var/www/laravel-real_state
            ./deploy.sh
```

---

## Monitoring

### Check Deployment Status
```bash
# Check if site is up
curl -I https://yourdomain.com

# Check logs
tail -f storage/logs/laravel.log

# Check PHP-FPM status
sudo systemctl status php8.1-fpm

# Check Nginx status
sudo systemctl status nginx
```

### Health Check Endpoint
Add to `routes/web.php`:
```php
Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now(),
        'version' => config('app.version')
    ]);
});
```

---

## Troubleshooting

### Deployment Fails

**Check logs:**
```bash
tail -f storage/logs/laravel.log
```

**Common issues:**
- Permissions: `sudo chown -R www-data:www-data storage bootstrap/cache`
- Missing .env: `cp .env.example .env`
- Database connection: Check .env credentials
- Composer memory: `COMPOSER_MEMORY_LIMIT=-1 composer install`

### Site Down After Deployment

**Quick fix:**
```bash
php artisan up
php artisan cache:clear
sudo systemctl restart php8.1-fpm
```

**If still down:**
```bash
./rollback.sh 1
```

---

## Best Practices

1. **Always test locally first**
2. **Backup before deployment**
3. **Deploy during low-traffic hours**
4. **Monitor logs after deployment**
5. **Have rollback plan ready**
6. **Test critical features post-deployment**

---

## Security Notes

- Never commit `.env` file
- Use SSH keys for git authentication
- Restrict script permissions: `chmod 750 *.sh`
- Run scripts as www-data user in production
- Keep deployment logs for audit trail

---

## Support

For detailed deployment guide, see: `DEPLOYMENT.md`

For issues, check:
- Application logs: `storage/logs/laravel.log`
- Web server logs: `/var/log/nginx/error.log`
- PHP-FPM logs: `/var/log/php8.1-fpm.log`
