# AI Copilot Instructions - Appointment Management System

## Project Overview
Laravel 12 appointment scheduling application managing **Clients**, **Staff**, **Services**, **Appointments**, and **Schedules**. Uses Pest for testing, Tailwind CSS for UI, and SQLite for development.

## Architecture

### Database Schema (5 Core Entities)
- **Client**: Personal info, contact details
- **Staff**: Assigned appointments, personal info
- **ServiceType**: Service metadata (duration, cost)
- **Appointment**: Central booking entity linking Client→Staff→Service with date/time/status
- **Schedule**: Staff availability slots (Staff→System bindings)
- **System**: Global configuration for appointment defaults

**Key Relationship**: Appointments are the core; they connect Clients, Staff, and ServiceTypes with temporal data.

### Technology Stack
- **Framework**: Laravel 12 with Eloquent ORM
- **Testing**: Pest 3.8 (see `tests/` structure)
- **CSS**: Tailwind CSS 4 via Vite
- **Package Manager**: Composer + npm
- **Database**: SQLite (default) configured in `.env`

## Development Workflows

### Setup & Running
```bash
composer setup          # One-time setup (installs, generates key, migrates, builds)
composer dev           # Runs server + queue + Vite dev server concurrently
npm run dev            # Front-end only (Vite)
php artisan serve      # Server only on port 8000
```

### Database
- **Migrations**: Located in `database/migrations/` (timestamp-based naming convention)
- **Create migration**: `php artisan make:migration create_<table>_table`
- **Run migrations**: `php artisan migrate` (auto-runs on `composer setup`)
- **Rollback**: `php artisan migrate:rollback`
- **Fresh**: `php artisan migrate:fresh` (destructive)

### Testing & Quality
```bash
composer test         # Runs Pest with config clear (see phpunit.xml)
php artisan test      # Run tests without clearing config
php artisan pint      # Auto-fix code style (Laravel Pint)
```

### Code Generation
Use Artisan for common scaffolding (speeds up development):
```bash
php artisan make:controller StaffController --resource   # CRUD controller
php artisan make:model Staff --migration                # Model + migration
php artisan make:migration create_staff_table
php artisan tinker    # Interactive REPL for quick queries
```

## Conventions

### Model Structure (`app/Models/`)
- **Mass Assignment**: Use `$fillable` to whitelist attributes (not `$guarded`)
- **Relationships**: Define in model methods returning relationship instances
- **Factories**: Located in `database/factories/` for seeding/testing
- **Example** (`User` model):
  ```php
  protected $fillable = ['name', 'email', 'password'];
  public function casts(): array { return ['email_verified_at' => 'datetime']; }
  ```

### Controller Patterns (`app/Http/Controllers/`)
- **RESTful Resource Controllers**: Use method names (index, create, store, show, edit, update, destroy)
- **Route Model Binding**: Type-hint model in method signature (Laravel auto-injects)
- **Return Views**: Use `return view('resource.view', ['model' => $model])`

### View Structure (`resources/views/`)
- **Blade Templates**: Use `.blade.php` extension
- **Naming**: Match controller resource (e.g., `staff/index.blade.php`, `staff/edit.blade.php`)
- **Styling**: Tailwind CSS classes (no custom CSS in `resources/css/app.css` unless necessary)
- **Forms**: Use POST/PATCH/DELETE via `@method` directive for RESTful compliance

### Routing (`routes/web.php`)
- **Resource Routes**: Use `Route::resource('staff', StaffController::class)` for full CRUD
- **Specific Routes**: Add custom routes below resource declarations
- **Route Naming**: Auto-generated from resource (staff.index, staff.create, staff.store, etc.)

### Testing Pattern (Pest)
- **Feature Tests**: In `tests/Feature/` for HTTP endpoint testing
- **Unit Tests**: In `tests/Unit/` for isolated logic
- **Example structure**:
  ```php
  test('staff can be created', function () {
      $response = $this->post('/staff', ['name' => 'John']);
      expect($response->status())->toBe(201);
  });
  ```

## Integration Points

### Factory-Based Seeding
- Factories in `database/factories/` generate fake data using FakerPHP
- Used in `DatabaseSeeder` for populating test data
- Reference: `User` factory pattern applies to all models

### Queue System
- Configured in `config/queue.php`
- Dev command includes `queue:listen` for background jobs
- Use `php artisan make:job JobName` for async tasks

### Environment Configuration
- `.env` file contains database, app, and mail settings
- Key files: `config/app.php`, `config/database.php`, `config/auth.php`
- Never commit `.env`; use `.env.example` as template

## Common Debugging

**Issue**: Route not found → Check `php artisan route:list` to verify registration  
**Issue**: Migration fails → Ensure foreign keys reference existing tables in correct order  
**Issue**: Model not found → Verify `app/Models/` namespace matches import (`App\Models\Staff`)  
**Issue**: View not found → Check `resources/views/` path matches view name exactly  

## File Reference
- Controllers: `app/Http/Controllers/`
- Models: `app/Models/`
- Migrations: `database/migrations/`
- Views: `resources/views/`
- Routes: `routes/web.php`
- Config: `config/` (app.php, database.php, auth.php)
- Tests: `tests/Feature/` and `tests/Unit/`
