# Property Marketplace

A modern real estate listing platform built with Laravel. This project powers a marketplace where agents and developers showcase properties and potential buyers can search and explore listings in a beautiful interface.

## Features

- Browse properties with filters for location, price, and amenities
- Manage listings from dedicated agent and developer dashboards
- Upload floor plans, master plans, and location maps
- Maintain communities, amenities, and blog posts via the admin panel
- Vendor registration, visitor tracking, and complaint forms
- Multi-language interface (English and Arabic)
- Role-based authentication for admins and users

## Tech Stack

- **Laravel 10** backend with Sanctum authentication
- **Bootstrap 5** and **Vite** for the frontend
- **MySQL** (or your preferred database)
- **Docker** support via Laravel Sail (optional)

## Local Setup

```bash
# Clone the repository
# Install PHP & Composer dependencies
composer install

# Copy environment file and generate key
cp .env.example .env
php artisan key:generate

# Install Node dependencies and compile assets
npm install && npm run build

# Run migrations and start the dev server
php artisan migrate
php artisan serve
```

## Running Tests

```bash
./vendor/bin/phpunit
```

## License

This project is open-sourced under the [MIT license](LICENSE).
