# Developer Guide

## Quick Start

### Prerequisites
- PHP 8.1+
- Composer 2.x
- Node.js 18+ & npm
- MySQL 8.0+ or MariaDB 10.3+
- Redis (recommended for caching)
- Docker (optional, via Laravel Sail)

### Initial Setup

```bash
# Clone and install
git clone <repository>
cd laravel-real_state

# Using Docker (Laravel Sail)
./vendor/bin/sail up -d
./vendor/bin/sail composer install
./vendor/bin/sail npm install

# OR without Docker
composer install
npm install

# Environment
cp .env.example .env
php artisan key:generate

# Configure .env for Docker
DB_HOST=mysql
REDIS_HOST=redis
MEMCACHED_HOST=memcached

# Database
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan db:seed

# Build assets
npm run build

# Access at http://localhost
```

### Default Credentials

After seeding:
- **Admin:** admin@example.com / password
- **Agent:** agent@example.com / password
- **Developer:** developer@example.com / password

## Development Workflow

### 1. Feature Development

```bash
# Create feature branch
git checkout -b feature/your-feature

# Make changes
# Run tests
php artisan test

# Commit
git add .
git commit -m "feat: your feature description"
```

### 2. Database Changes

```bash
# Create migration
./vendor/bin/sail artisan make:migration create_table_name

# Run migration
./vendor/bin/sail artisan migrate

# Rollback if needed
./vendor/bin/sail artisan migrate:rollback

# Fresh install (drops all tables)
./vendor/bin/sail artisan migrate:fresh --seed
```

**Important:** All migrations are squashed (one per table). If you need to modify a table:
- Create a new migration with `Schema::table()`
- Don't modify existing create migrations

### 3. Adding Translations

```php
// In Blade views
{{ __('Your translation key') }}

// In controllers
return redirect()->back()->with('success', __('success.created', ['item' => __('Property')]));
```

Add keys to:
- `lang/en/app.php`
- `lang/es/app.php`
- `lang/ca/app.php`

### 4. Creating Controllers

```bash
# Admin controller
php artisan make:controller Admin/YourController

# Use eager loading
public function index() {
    $items = YourModel::with(['relation1', 'relation2'])->get();
    return view('admin.your.index', compact('items'));
}

# Use caching for expensive queries
public function index() {
    $items = Cache::remember('your.cache.key', 3600, function() {
        return YourModel::with('relations')->get();
    });
    return view('admin.your.index', compact('items'));
}
```

### 5. Adding Permissions

```php
// In database/seeders/RolePermissionSeeder.php
Permission::create(['name' => 'your.resource.view']);
Permission::create(['name' => 'your.resource.create']);
Permission::create(['name' => 'your.resource.edit']);
Permission::create(['name' => 'your.resource.delete']);

// Assign to roles
$adminRole->givePermissionTo(['your.resource.*']);
```

```blade
{{-- In views --}}
@can('your.resource.create')
    <a href="{{ route('your.create') }}">Create</a>
@endcan
```

### 6. Form Validation

```bash
# Create request class
php artisan make:request YourFormRequest
```

```php
// app/Http/Requests/YourFormRequest.php
public function rules() {
    return [
        'name' => 'required|string|max:255',
        'email' => 'required|email|dns',
        'phone' => ['required', 'regex:/^\+?[0-9]{10,15}$/'],
    ];
}

public function messages() {
    return [
        'name.required' => __('validation.required', ['attribute' => __('Name')]),
    ];
}
```

## Code Standards

### Naming Conventions

```php
// Controllers: PascalCase + Controller suffix
class PropertyController extends Controller {}

// Models: PascalCase, singular
class Property extends Model {}

// Methods: camelCase
public function getProperties() {}

// Variables: camelCase
$propertyList = [];

// Constants: UPPER_SNAKE_CASE
const MAX_UPLOAD_SIZE = 5242880;

// Routes: kebab-case
Route::get('/property-details/{id}', ...);

// Views: kebab-case
resources/views/admin/property-list.blade.php

// Database tables: snake_case
floor_plans (not floorPlans)
master_plans (not masterPlans)
```

### Controller Structure

```php
class YourController extends Controller
{
    // 1. Properties
    protected $service;
    
    // 2. Constructor
    public function __construct(YourService $service) {
        $this->service = $service;
    }
    
    // 3. Resource methods (in order)
    public function index() {}
    public function create() {}
    public function store(Request $request) {}
    public function show($id) {}
    public function edit($id) {}
    public function update(Request $request, $id) {}
    public function destroy($id) {}
    
    // 4. Custom methods
    public function customMethod() {}
}
```

### Model Structure

```php
class YourModel extends Model
{
    // 1. Table name (REQUIRED if not snake_case plural)
    protected $table = 'your_table';
    
    // Examples:
    // FloorPlan → protected $table = 'floor_plans';
    // MasterPlan → protected $table = 'master_plans';
    
    // 2. Fillable/guarded
    protected $fillable = ['field1', 'field2'];
    
    // 3. Casts
    protected $casts = [
        'is_active' => 'boolean',
        'published_at' => 'datetime',
    ];
    
    // 4. Relationships
    public function relatedModel() {
        return $this->belongsTo(RelatedModel::class);
    }
    
    // 5. Accessors/Mutators
    public function getFullNameAttribute() {
        return "{$this->first_name} {$this->last_name}";
    }
    
    // 6. Scopes
    public function scopeActive($query) {
        return $query->where('is_active', true);
    }
}
```

### Blade Best Practices

```blade
{{-- 1. Use components for reusable elements --}}
<x-admin.crud-actions :item="$item" route="properties" />

{{-- 2. Always escape output (default) --}}
{{ $variable }}

{{-- 3. Use @can for permissions --}}
@can('property.edit')
    <a href="{{ route('property.edit', $property) }}">Edit</a>
@endcan

{{-- 4. Use translation helpers --}}
{{ __('Welcome') }}

{{-- 5. Use @foreach with @empty --}}
@forelse($items as $item)
    <li>{{ $item->name }}</li>
@empty
    <li>{{ __('No items found') }}</li>
@endforelse

{{-- 6. Use config helpers --}}
{{ config('company.name') }}
```

## Performance Guidelines

### 1. Always Eager Load Relationships

```php
// ❌ Bad - N+1 queries
$properties = Property::all();
foreach ($properties as $property) {
    echo $property->developer->name; // Query per property
}

// ✅ Good - 2 queries total
$properties = Property::with('developer')->get();
foreach ($properties as $property) {
    echo $property->developer->name;
}
```

### 2. Use Caching for Expensive Queries

```php
// ❌ Bad - Query every time
$developers = Developer::with('properties')->get();

// ✅ Good - Cache for 1 hour
$developers = Cache::remember('developers.all', 3600, function() {
    return Developer::with('properties')->get();
});

// Don't forget to invalidate
Cache::forget('developers.all'); // On update/delete
```

### 3. Paginate Large Datasets

```php
// ❌ Bad - Load all records
$properties = Property::all();

// ✅ Good - Paginate
$properties = Property::paginate(20);
```

### 4. Select Only Needed Columns

```php
// ❌ Bad - Select all columns
$properties = Property::all();

// ✅ Good - Select specific columns
$properties = Property::select('id', 'title', 'price')->get();
```

## Testing Guidelines

### Feature Tests

```php
// tests/Feature/YourFeatureTest.php
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class YourFeatureTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_user_can_view_properties()
    {
        $user = User::factory()->create();
        
        $response = $this->actingAs($user)
            ->get(route('properties.index'));
        
        $response->assertStatus(200);
        $response->assertViewIs('properties.index');
    }
    
    public function test_user_cannot_create_without_permission()
    {
        $user = User::factory()->create();
        
        $response = $this->actingAs($user)
            ->post(route('properties.store'), [
                'title' => 'Test Property',
            ]);
        
        $response->assertStatus(403);
    }
}
```

### Running Tests

```bash
# All tests
php artisan test

# Specific test
php artisan test --filter YourFeatureTest

# With coverage
php artisan test --coverage

# Parallel execution
php artisan test --parallel
```

## Debugging

### Laravel Telescope

```bash
# Install (dev only)
composer require laravel/telescope --dev
php artisan telescope:install
php artisan migrate

# Access at: http://localhost:8000/telescope
```

### Query Debugging

```php
// Enable query log
DB::enableQueryLog();

// Your queries here
$properties = Property::with('developer')->get();

// Dump queries
dd(DB::getQueryLog());
```

### Dump Helpers

```php
// Dump and die
dd($variable);

// Dump and continue
dump($variable);

// Ray (if installed)
ray($variable);
```

## Common Tasks

### Add New Language

1. Create language directory: `lang/xx/`
2. Copy `lang/en/app.php` to `lang/xx/app.php`
3. Translate all keys
4. Update language switcher in views

### Add New Location

```php
// config/locations.php
'major_cities' => [
    'New City',
    // ... existing cities
],
```

### Clear All Caches

```bash
php artisan optimize:clear
# or individually:
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
```

### Update Company Information

```env
# .env
COMPANY_NAME="Your Company"
COMPANY_TAGLINE="Your Tagline"
COMPANY_ADDRESS_STREET="Your Street"
COMPANY_ADDRESS_CITY="Your City"
COMPANY_PHONE="+34 XX XXX XXXX"
COMPANY_EMAIL="info@yourcompany.com"
```

## Troubleshooting

### Permission Denied Errors

```bash
# Fix storage permissions
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### Migration Errors

```bash
# Reset database (dev only)
php artisan migrate:fresh --seed

# Rollback last migration
php artisan migrate:rollback

# Check migration status
php artisan migrate:status
```

### Cache Issues

```bash
# Clear all caches
php artisan optimize:clear

# Rebuild caches
php artisan optimize
```

### Asset Build Errors

```bash
# Clear node_modules
rm -rf node_modules package-lock.json
npm install

# Rebuild assets
npm run build
```

## Resources

- **Laravel Docs:** https://laravel.com/docs/10.x
- **Spatie Permission:** https://spatie.be/docs/laravel-permission
- **Bootstrap 5:** https://getbootstrap.com/docs/5.3
- **Project Docs:** See `ARCHITECTURE.md`, `DEPLOYMENT.md`

## Getting Help

1. Check existing documentation in project root
2. Review Laravel official documentation
3. Search GitHub issues
4. Ask team members
5. Create detailed bug report with steps to reproduce
