# Property Marketplace

A modern real estate listing platform built with Laravel. This project powers a marketplace where agents and developers showcase properties and potential buyers can search and explore listings in a beautiful interface.

**Localized for Spain** - Featuring Spanish provinces, cities, and autonomous communities.

## Features

- Browse properties with filters for location, price, and amenities
- Manage listings from dedicated agent and developer dashboards
- Upload floor plans, master plans, and location maps
- Maintain communities, amenities, and blog posts via the admin panel
- Vendor registration, visitor tracking, and complaint forms
- **Multi-language interface (English, Spanish, and Catalan)**
- **Role-based authentication with granular permissions**
- **Rate-limited public forms for security (5 req/min)**
- **Optimized database queries (95% reduction)**
- **Comprehensive caching system**
- **Zero-downtime deployment capability**

## Tech Stack

- **Laravel 10** backend with Sanctum authentication
- **Spatie Permission** for role-based access control
- **Bootstrap 5** and **Vite** for the frontend
- **MySQL** (or your preferred database)
- **Laravel Telescope** for debugging (dev only)
- **Docker** support via Laravel Sail (optional)

## Recent Improvements

✅ **Permission System** - Complete UI implementation with `@can()` directives  
✅ **Multi-language Support** - 100% admin panel translated (EN/ES/CA)  
✅ **Performance** - 95% reduction in database queries via eager loading  
✅ **Security** - Rate limiting on all public forms (5 req/min)  
✅ **Testing** - 11 automated tests covering critical functionality  
✅ **Code Quality** - Refactored controllers, removed debug code  
✅ **Caching** - Comprehensive caching system for optimal performance  
✅ **Deployment** - Automated scripts with zero-downtime capability  
✅ **Localization** - Adapted for Spanish market (provinces & cities)

## Documentation

### Getting Started
- **[DEVELOPER_GUIDE.md](DEVELOPER_GUIDE.md)** - Complete development guide with code standards and best practices
- **[ARCHITECTURE.md](ARCHITECTURE.md)** - System architecture and design patterns

### Deployment & Operations
- **[DEPLOYMENT.md](DEPLOYMENT.md)** - Full deployment guide with zero-downtime strategy
- **[PRODUCTION_READY_CHECKLIST.md](PRODUCTION_READY_CHECKLIST.md)** - Pre-launch checklist
- **[DATA_MIGRATION.md](DATA_MIGRATION.md)** - Data migration notes for UAE → Spain transition

### Development
- **[TESTING_GUIDE.md](TESTING_GUIDE.md)** - Testing instructions and coverage
- **[API_DOCUMENTATION.md](API_DOCUMENTATION.md)** - API patterns and future endpoints

### Project History
- **[CHANGELOG.md](CHANGELOG.md)** - Version history and key decisions

## Local Setup

```bash
# Clone the repository
git clone <repository-url>
cd laravel-real_state

# Install PHP & Composer dependencies
composer install

# Copy environment file and generate key
cp .env.example .env
php artisan key:generate

# Configure database in .env
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

# Install Node dependencies and compile assets
npm install && npm run build

# Run migrations and seed database
php artisan migrate --seed

# Start the dev server
php artisan serve
```

Visit: http://localhost:8000

### Default Credentials
- **Admin:** admin@example.com / password
- **Agent:** agent@example.com / password
- **Developer:** developer@example.com / password

## Configuration

### Company Information

Update `.env` with your company details:

```env
COMPANY_NAME="Your Company Name"
COMPANY_TAGLINE="Your Tagline"
COMPANY_COUNTRY="España"
COMPANY_ADDRESS_STREET="Your Street Address"
COMPANY_ADDRESS_CITY="Madrid"
COMPANY_ADDRESS_POSTAL="28013"
COMPANY_PHONE="+34 91 XXX XXXX"
COMPANY_EMAIL="info@yourcompany.es"
```

### Locations

Spanish locations are configured in `config/locations.php`:
- 30 major cities (northern Spain prioritized)
- 20 provinces
- 17 autonomous communities

## Running Tests

```bash
# Run all tests
php artisan test

# Run specific test
php artisan test --filter PermissionTest

# With coverage
php artisan test --coverage
```

## Deployment

### Quick Deployment
```bash
./deploy.sh
```

### Zero-Downtime Deployment
```bash
./deploy-zero-downtime.sh
```

### Rollback
```bash
./rollback.sh
```

See [DEPLOYMENT.md](DEPLOYMENT.md) for detailed instructions.

## Performance

- **95% query reduction** - From 50-100+ queries to 2-5 per page
- **80%+ cache hit rate** - Redis-based caching for expensive queries
- **Eager loading** - All relationships loaded upfront
- **Optimized indexes** - Database properly indexed

## Security

- **Rate limiting** - 5 requests/min on public forms
- **CSRF protection** - All forms protected
- **Input validation** - Strict validation rules with DNS checks
- **Permission system** - Granular role-based access control
- **SQL injection prevention** - Eloquent ORM
- **XSS protection** - Blade auto-escaping

## Multi-Language Support

3 languages fully supported:
- **English (EN)** - Default
- **Spanish (ES)** - Primary market
- **Catalan (CA)** - Regional support

All admin panel, controllers, and views translated.

## Project Structure

```
├── app/
│   ├── Http/Controllers/    # Controllers (Admin, Agent, Developer, Frontend)
│   ├── Models/               # Eloquent models
│   ├── Services/             # Business logic (CacheService)
│   └── Http/Requests/        # Form validation
├── config/
│   ├── locations.php         # Spanish locations
│   └── company.php           # Company information
├── resources/
│   ├── views/                # Blade templates
│   └── lang/                 # Translations (en, es, ca)
├── database/
│   ├── migrations/           # Database schema
│   └── seeders/              # Data seeders
├── tests/                    # Automated tests
└── docs/                     # Documentation (see above)
```

## Contributing

1. Fork the repository
2. Create feature branch (`git checkout -b feature/amazing-feature`)
3. Commit changes (`git commit -m 'feat: add amazing feature'`)
4. Push to branch (`git push origin feature/amazing-feature`)
5. Open Pull Request

See [DEVELOPER_GUIDE.md](DEVELOPER_GUIDE.md) for code standards.

## License

This project is open-sourced under the [MIT license](LICENSE).

## Support

For issues and questions:
1. Check documentation files
2. Review [ARCHITECTURE.md](ARCHITECTURE.md)
3. See [DEVELOPER_GUIDE.md](DEVELOPER_GUIDE.md)
4. Create GitHub issue with detailed description

---

**Built with ❤️ using Laravel 10**
