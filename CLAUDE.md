# CLAUDE.md - Module Profession

This file provides guidance to Claude Code when working with the `hanafalah/module-profession` module.

## Module Overview

Module Profession is a Laravel package for managing professional classifications in healthcare systems. It provides a hierarchical structure for organizing:

- **Professions** - High-level professional categories (e.g., Doctor, Nurse, Pharmacist)
- **Occupations** - Specific roles within a profession (e.g., General Practitioner, Surgeon)
- **Job Desks** - Detailed job responsibilities and duties

All entities are stored in the `unicodes` table using the Unicode model pattern from `laravel-support`.

## Package Information

- **Namespace:** `Hanafalah\ModuleProfession`
- **Dependencies:**
  - `hanafalah/laravel-support` - Base support library with Unicode model
  - `hanafalah/module-transaction` - Transaction management

## Directory Structure

```
src/
├── Commands/
│   ├── EnvironmentCommand.php      # Base command class
│   └── InstallMakeCommand.php      # php artisan module-profession:install
├── Concerns/
│   └── Relation/
│       ├── HasProfession.php       # Trait for profession relationships
│       ├── HasOccupation.php       # Trait for occupation relationships
│       └── HasJobDesk.php          # Trait for job desk relationships
├── Contracts/
│   ├── Data/
│   │   ├── ProfessionData.php
│   │   ├── OccupationData.php
│   │   └── JobDeskData.php
│   ├── Schemas/
│   │   ├── Profession.php
│   │   ├── Occupation.php
│   │   └── JobDesk.php
│   └── ModuleProfession.php
├── Data/
│   ├── ProfessionData.php          # DTO with flag='Profession'
│   ├── OccupationData.php          # DTO with flag='Occupation'
│   └── JobDeskData.php             # DTO with flag='JobDesk'
├── Enums/
│   └── Profession/
│       └── Flag.php                # OCCUPATION, PROFESSION, JOB_DESK
├── Facades/
│   └── ModuleProfession.php
├── Models/
│   ├── Profession/
│   │   └── Profession.php          # Extends Unicode
│   ├── Occupation/
│   │   └── Occupation.php          # Extends Profession
│   └── JobDesk/
│       └── JobDesk.php             # Extends Occupation
├── Providers/
│   └── CommandServiceProvider.php
├── Resources/
│   ├── Profession/
│   │   ├── ViewProfession.php
│   │   └── ShowProfession.php
│   ├── Occupation/
│   │   ├── ViewOccupation.php
│   │   └── ShowOccupation.php
│   └── JobDesk/
│       ├── ViewJobDesk.php
│       └── ShowJobDesk.php
├── Schemas/
│   ├── Profession.php              # Base schema with caching
│   ├── Occupation.php              # Extends Profession schema
│   └── JobDesk.php                 # Extends Occupation schema
├── Supports/
│   └── BaseModuleProfession.php
├── ModuleProfession.php
└── ModuleProfessionServiceProvider.php
```

## Entity Hierarchy

The module uses an inheritance hierarchy both in Models and Schemas:

```
Profession (base)
    └── Occupation (extends Profession)
            └── JobDesk (extends Occupation)
```

All models use the `unicodes` table and are differentiated by the `flag` field:
- `PROFESSION` - For profession records
- `OCCUPATION` - For occupation records
- `JOB_DESK` - For job desk records

## Key Components

### Models

All models extend `Hanafalah\LaravelSupport\Models\Unicode\Unicode` and use the `unicodes` table:

```php
// Profession is the base model
class Profession extends Unicode
{
    protected $table = 'unicodes';
}

// Occupation extends Profession
class Occupation extends Profession {}

// JobDesk extends Occupation
class JobDesk extends Occupation {}
```

### Data Transfer Objects (DTOs)

DTOs automatically set the `flag` attribute:

```php
// ProfessionData sets flag='Profession'
// OccupationData sets flag='Occupation'
// JobDeskData sets flag='JobDesk'
```

### Schemas

Schemas provide query building and data preparation:

```php
// Get profession query builder
$schema->profession($conditionals);

// Prepare and store a profession
$schema->prepareStoreProfession($professionData);
```

### Relation Traits

Use these traits to add relationships to your models:

```php
use Hanafalah\ModuleProfession\Concerns\Relation\HasProfession;
use Hanafalah\ModuleProfession\Concerns\Relation\HasOccupation;
use Hanafalah\ModuleProfession\Concerns\Relation\HasJobDesk;

class Employee extends Model
{
    use HasProfession;    // Adds profession() relationship
    use HasOccupation;    // Adds occupation() relationship
    use HasJobDesk;       // Adds jobDesk(), jobDesks() relationships
}
```

### Caching Configuration

Schemas implement caching for performance:

```php
// Profession - cached forever with tags ['profession', 'profession-index']
// Occupation - cached 24 hours with tags ['occupation', 'occupation-index']
// JobDesk - cached forever with tags ['job_desk', 'job_desk-index']
```

## Installation

```bash
php artisan module-profession:install
```

This publishes:
- Configuration file to `config/module-profession.php`
- Migration files

## ServiceProvider Warning

**IMPORTANT:** The current `ModuleProfessionServiceProvider` uses `registers(['*'])`:

```php
public function register()
{
    $this->registerMainClass(ModuleProfession::class)
        ->registerCommandService(Providers\CommandServiceProvider::class)
        ->registers(['*']);  // <-- AVOID THIS PATTERN
}
```

**Do NOT use `registers(['*'])` in BaseServiceProvider implementations.** This wildcard registration:
- Automatically registers all files in conventional directories
- Can cause unexpected class loading and performance issues
- Makes it difficult to track what is being registered
- Can lead to circular dependency problems

**Recommended approach:** Explicitly specify what to register:

```php
public function register()
{
    $this->registerMainClass(ModuleProfession::class)
        ->registerCommandService(Providers\CommandServiceProvider::class)
        ->registers([
            'model',
            'schema',
            'data',
            'resource'
        ]);
}
```

Or use individual registration methods for full control:

```php
public function register()
{
    $this->registerMainClass(ModuleProfession::class)
        ->registerCommandService(Providers\CommandServiceProvider::class)
        ->registerModels()
        ->registerSchemas()
        ->registerData()
        ->registerResources();
}
```

## Usage Examples

### Creating a Profession

```php
use Hanafalah\ModuleProfession\Data\ProfessionData;
use Hanafalah\ModuleProfession\Schemas\Profession;

$schema = app(Profession::class);
$dto = ProfessionData::from([
    'name' => 'Medical Doctor',
    'code' => 'MD'
]);
$profession = $schema->prepareStoreProfession($dto);
```

### Querying Professions

```php
use Hanafalah\ModuleProfession\Schemas\Profession;

$schema = app(Profession::class);
$professions = $schema->profession()->get();
```

### Using Relation Traits

```php
// In your model
class HealthcareWorker extends Model
{
    use HasProfession;
    use HasOccupation;
}

// Usage
$worker = HealthcareWorker::with(['profession', 'occupation'])->find($id);
echo $worker->profession->name;  // "Medical Doctor"
echo $worker->occupation->name;  // "General Practitioner"
```

## Configuration

Configuration file: `config/module-profession.php`

```php
return [
    'commands' => [
        // Registered artisan commands
    ],
    'app' => [
        'contracts' => [
            // Custom contract bindings
        ],
    ],
    'libs' => [
        'model' => 'Models',
        'contract' => 'Contracts',
        'schema' => 'Schemas',
        'database' => 'Database',
        'data' => 'Data',
        'resource' => 'Resources',
        'migration' => '../assets/database/migrations'
    ],
    'database' => [
        'models' => [
            // Model class mappings
        ]
    ]
];
```

## Enums

### Flag Enum

```php
use Hanafalah\ModuleProfession\Enums\Profession\Flag;

Flag::PROFESSION;   // 'PROFESSION'
Flag::OCCUPATION;   // 'OCCUPATION'
Flag::JOB_DESK;     // 'JOB_DESK'
```

## Common Tasks

### Adding a New Profession Type

1. Create a new Data class extending the appropriate parent
2. Create a new Model extending the appropriate parent
3. Create a new Schema extending the appropriate parent
4. Create View and Show resource classes
5. Add a new Flag enum value if needed

### Clearing Profession Cache

```php
Cache::tags(['profession', 'profession-index'])->flush();
Cache::tags(['occupation', 'occupation-index'])->flush();
Cache::tags(['job_desk', 'job_desk-index'])->flush();
```
