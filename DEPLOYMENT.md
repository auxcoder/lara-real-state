# Deployment Guide

## Server Requirements

### Minimum Specifications
- PHP 8.1 or higher
- MySQL 8.0 or MariaDB 10.3+
- Nginx or Apache
- Composer 2.x
- Node.js 18+ & NPM
- 2GB RAM minimum
- 10GB disk space

### PHP Extensions Required
```bash
php -m | grep -E "BCMath|Ctype|Fileinfo|JSON|Mbstring|OpenSSL|PDO|Tokenizer|XML|cURL|GD|Zip"
```

Required extensions:
- BCMath, Ctype, Fileinfo, JSON, Mbstring
- OpenSSL, PDO, Tokenizer, XML
- cURL, GD (for image processing)
- Zip

---

## Environment Setup

### 1. Clone Repository
```bash
git clone <repository-url>
cd laravel-real_state
```

### 2. Install Dependencies
```bash
# PHP dependencies
composer install --optimize-autoloader --no-dev

# JavaScript dependencies
npm install
npm run build
```

### 3. Environment Configuration
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Configure .env
```env
# Application
APP_NAME="Property Marketplace"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_secure_password

# Cache & Session
CACHE_DRIVER=file  # or redis for better performance
SESSION_DRIVER=file
QUEUE_CONNECTION=sync  # or database/redis for production

# Mail
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="${APP_NAME}"

# Redis (optional but recommended)
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

---

## Database Setup

### 1. Run Migrations
```bash
php artisan migrate --force
```

### 2. Seed Initial Data
```bash
# Seed permissions (REQUIRED)
php artisan db:seed --class=PermissionSeeder

# Create admin user
php artisan tinker
```

```php
// In Tinker:
$user = \App\Models\User::create([
    'name' => 'Admin',
    'email' => 'admin@yourdomain.com',
    'password' => bcrypt('secure-password-here')
]);

$user->givePermissionTo(\Spatie\Permission\Models\Permission::all());
// Or assign admin role if you have one
```

---

## File Permissions

```bash
# Set ownership
sudo chown -R www-data:www-data /path/to/laravel-real_state

# Set permissions
sudo chmod -R 755 /path/to/laravel-real_state
sudo chmod -R 775 /path/to/laravel-real_state/storage
sudo chmod -R 775 /path/to/laravel-real_state/bootstrap/cache

# Create storage link
php artisan storage:link
```

---

## Web Server Configuration

### Nginx
```nginx
server {
    listen 80;
    listen [::]:80;
    server_name yourdomain.com;
    root /path/to/laravel-real_state/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

### Apache (.htaccess already included)
Ensure `mod_rewrite` is enabled:
```bash
sudo a2enmod rewrite
sudo systemctl restart apache2
```

---

## SSL Certificate (Let's Encrypt)

```bash
# Install Certbot
sudo apt install certbot python3-certbot-nginx

# Obtain certificate
sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com

# Auto-renewal (already configured by certbot)
sudo certbot renew --dry-run
```

---

## Optimization

### 1. Cache Configuration
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 2. Optimize Autoloader
```bash
composer install --optimize-autoloader --no-dev
```

### 3. Enable OPcache
Edit `/etc/php/8.1/fpm/php.ini`:
```ini
opcache.enable=1
opcache.memory_consumption=128
opcache.interned_strings_buffer=8
opcache.max_accelerated_files=10000
opcache.revalidate_freq=2
```

---

## Queue Workers (Optional)

If using queues:

### 1. Create Supervisor Config
`/etc/supervisor/conf.d/laravel-worker.conf`:
```ini
[program:laravel-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /path/to/laravel-real_state/artisan queue:work --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
user=www-data
numprocs=2
redirect_stderr=true
stdout_logfile=/path/to/laravel-real_state/storage/logs/worker.log
stopwaitsecs=3600
```

### 2. Start Worker
```bash
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start laravel-worker:*
```

---

## Scheduled Tasks

Add to crontab:
```bash
sudo crontab -e -u www-data
```

Add this line:
```cron
* * * * * cd /path/to/laravel-real_state && php artisan schedule:run >> /dev/null 2>&1
```

---

## Monitoring & Logs

### Log Files
```bash
# Application logs
tail -f storage/logs/laravel.log

# Nginx logs
tail -f /var/log/nginx/error.log
tail -f /var/log/nginx/access.log

# PHP-FPM logs
tail -f /var/log/php8.1-fpm.log
```

### Log Rotation
Create `/etc/logrotate.d/laravel`:
```
/path/to/laravel-real_state/storage/logs/*.log {
    daily
    missingok
    rotate 14
    compress
    notifempty
    create 0640 www-data www-data
    sharedscripts
}
```

---

## Backup Strategy

### Database Backup
```bash
#!/bin/bash
# /usr/local/bin/backup-db.sh

DATE=$(date +%Y%m%d_%H%M%S)
BACKUP_DIR="/backups/database"
DB_NAME="your_database"

mysqldump -u username -p'password' $DB_NAME | gzip > $BACKUP_DIR/db_$DATE.sql.gz

# Keep only last 7 days
find $BACKUP_DIR -name "db_*.sql.gz" -mtime +7 -delete
```

### File Backup
```bash
#!/bin/bash
# /usr/local/bin/backup-files.sh

DATE=$(date +%Y%m%d_%H%M%S)
BACKUP_DIR="/backups/files"
APP_DIR="/path/to/laravel-real_state"

tar -czf $BACKUP_DIR/files_$DATE.tar.gz \
    $APP_DIR/storage/app/public \
    $APP_DIR/.env

# Keep only last 7 days
find $BACKUP_DIR -name "files_*.tar.gz" -mtime +7 -delete
```

### Cron Schedule
```cron
0 2 * * * /usr/local/bin/backup-db.sh
0 3 * * * /usr/local/bin/backup-files.sh
```

---

## Security Checklist

- [ ] `APP_DEBUG=false` in production
- [ ] `APP_ENV=production`
- [ ] Strong `APP_KEY` generated
- [ ] Database credentials secured
- [ ] File permissions set correctly (755/775)
- [ ] SSL certificate installed
- [ ] Firewall configured (UFW/iptables)
- [ ] SSH key-based authentication
- [ ] Fail2ban installed and configured
- [ ] Regular security updates scheduled
- [ ] Backup system tested and working

---

## Deployment Checklist

### Pre-Deployment
- [ ] Run tests: `php artisan test`
- [ ] Check for debug code
- [ ] Review .env configuration
- [ ] Backup current production database
- [ ] Backup current production files

### Deployment
- [ ] Pull latest code: `git pull origin main`
- [ ] Install dependencies: `composer install --no-dev`
- [ ] Run migrations: `php artisan migrate --force`
- [ ] Clear caches: `php artisan cache:clear`
- [ ] Rebuild caches: `php artisan config:cache`
- [ ] Build assets: `npm run build`
- [ ] Restart services: `sudo systemctl restart php8.1-fpm nginx`

### Post-Deployment
- [ ] Test homepage loads
- [ ] Test admin login
- [ ] Test property listings
- [ ] Test language switching
- [ ] Check error logs
- [ ] Verify SSL certificate
- [ ] Test form submissions
- [ ] Monitor performance

---

## Rollback Procedure

If deployment fails:

```bash
# 1. Revert code
git reset --hard HEAD~1

# 2. Restore database
mysql -u username -p database_name < backup.sql

# 3. Restore files
tar -xzf files_backup.tar.gz -C /

# 4. Clear caches
php artisan cache:clear
php artisan config:clear

# 5. Restart services
sudo systemctl restart php8.1-fpm nginx
```

---

## Troubleshooting

### 500 Internal Server Error
```bash
# Check logs
tail -f storage/logs/laravel.log

# Check permissions
ls -la storage bootstrap/cache

# Clear caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### Database Connection Error
```bash
# Test connection
php artisan tinker
DB::connection()->getPdo();

# Check credentials in .env
# Verify MySQL is running
sudo systemctl status mysql
```

### Assets Not Loading
```bash
# Rebuild assets
npm run build

# Check storage link
php artisan storage:link

# Verify file permissions
ls -la public/storage
```

---

## Performance Tuning

### Enable Redis (Recommended)
```bash
# Install Redis
sudo apt install redis-server

# Update .env
CACHE_DRIVER=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis

# Restart services
sudo systemctl restart redis-server
php artisan config:cache
```

### Database Optimization
```sql
-- Add indexes (already included in migrations)
-- Optimize tables monthly
OPTIMIZE TABLE agent_properties, developer_properties, blogs;

-- Analyze tables
ANALYZE TABLE agent_properties, developer_properties;
```

---

## Support & Maintenance

### Regular Maintenance Tasks
- **Daily**: Check error logs
- **Weekly**: Review performance metrics
- **Monthly**: Update dependencies, optimize database
- **Quarterly**: Security audit, backup restoration test

### Update Procedure
```bash
# Update dependencies
composer update
npm update

# Run tests
php artisan test

# Deploy if tests pass
```

---

## Contact & Resources

- **Laravel Documentation**: https://laravel.com/docs
- **Spatie Permission**: https://spatie.be/docs/laravel-permission
- **Server Requirements**: https://laravel.com/docs/10.x/deployment

---

**Last Updated**: 2026-01-31  
**Laravel Version**: 10.x  
**PHP Version**: 8.1+
