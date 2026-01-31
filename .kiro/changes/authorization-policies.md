# Authorization Policies Implementation

**Date:** 2026-01-30  
**Status:** Completed - Core Policies Created

## Summary

Implemented Laravel authorization policies to control access to resources based on user permissions. Policies integrate with the existing Spatie Laravel Permission package to provide fine-grained access control.

## Benefits

1. **Centralized Authorization** - All authorization logic in one place per model
2. **Reusable** - Policies can be used across controllers, views, and APIs
3. **Testable** - Authorization logic can be tested independently
4. **Integration** - Works seamlessly with Spatie permissions
5. **Automatic** - `authorizeResource()` automatically checks permissions for all CRUD actions

## Policies Created (3 total)

### 1. AgentPropertyPolicy
**Location:** `app/Policies/AgentPropertyPolicy.php`  
**Model:** AgentProperty

**Permissions Required:**
- `viewAny()` - "view properties"
- `view()` - "view properties"
- `create()` - "create properties"
- `update()` - "edit properties"
- `delete()` - "delete properties"
- `restore()` - "delete properties"
- `forceDelete()` - "delete properties"

### 2. DeveloperPropertyPolicy
**Location:** `app/Policies/DeveloperPropertyPolicy.php`  
**Model:** DeveloperProperty

**Permissions Required:**
- `viewAny()` - "view developer properties"
- `view()` - "view developer properties"
- `create()` - "create developer properties"
- `update()` - "edit developer properties"
- `delete()` - "delete developer properties"
- `restore()` - "delete developer properties"
- `forceDelete()` - "delete developer properties"

### 3. CommunityPolicy
**Location:** `app/Policies/CommunityPolicy.php`  
**Model:** Community

**Permissions Required:**
- `viewAny()` - "view communities"
- `view()` - "view communities"
- `create()` - "create communities"
- `update()` - "edit communities"
- `delete()` - "delete communities"
- `restore()` - "delete communities"
- `forceDelete()` - "delete communities"

## How Policies Work

### Policy Structure
```php
class AgentPropertyPolicy
{
    public function update(User $user, AgentProperty $property): bool
    {
        return $user->hasPermissionTo('edit properties');
    }
}
```

### Automatic Authorization in Controllers
```php
class AgentPropertyController extends Controller
{
    public function __construct()
    {
        // Automatically authorizes all resource methods
        $this->authorizeResource(AgentProperty::class, 'property');
    }
    
    // No manual authorization needed - policy checks automatically!
    public function update(Request $request, $id) { }
}
```

### Method Mapping
`authorizeResource()` automatically maps controller methods to policy methods:

| Controller Method | Policy Method | Permission Checked |
|------------------|---------------|-------------------|
| index() | viewAny() | "view properties" |
| show() | view() | "view properties" |
| create() | create() | "create properties" |
| store() | create() | "create properties" |
| edit() | update() | "edit properties" |
| update() | update() | "edit properties" |
| destroy() | delete() | "delete properties" |

### Manual Authorization (Alternative)
```php
// In controller
public function update(Request $request, AgentProperty $property)
{
    $this->authorize('update', $property);
    // ... update logic
}

// In Blade views
@can('update', $property)
    <a href="{{ route('property.edit', $property) }}">Edit</a>
@endcan

// In code
if (auth()->user()->can('update', $property)) {
    // Allow action
}
```

## Integration with Spatie Permissions

The application uses **Spatie Laravel Permission** for role and permission management. Policies check these permissions:

```php
// Policy checks permission
public function update(User $user, AgentProperty $property): bool
{
    return $user->hasPermissionTo('edit properties');
}

// Spatie handles the permission check
// Checks: users -> model_has_permissions -> permissions
```

### Permission Structure
```
Roles:
- Admin (has all permissions)
- Editor (has view, create, edit)
- Viewer (has view only)

Permissions:
- view properties
- create properties
- edit properties
- delete properties
```

## Authorization Flow

```
1. User requests: GET /admin/property/1/edit

2. Controller constructor runs:
   $this->authorizeResource(AgentProperty::class)

3. Laravel checks policy:
   AgentPropertyPolicy->update($user, $property)

4. Policy checks permission:
   $user->hasPermissionTo('edit properties')

5. Spatie checks database:
   - User has role "Editor"?
   - Role has permission "edit properties"?

6. Result:
   ✅ Authorized → Show edit form
   ❌ Unauthorized → 403 Forbidden
```

## Error Handling

### Unauthorized Access
```php
// Returns 403 Forbidden automatically
public function update(Request $request, $id)
{
    // If user lacks permission, Laravel throws AuthorizationException
    // No need for manual checks!
}
```

### Custom Error Messages
```php
public function update(User $user, AgentProperty $property): bool
{
    return $user->hasPermissionTo('edit properties')
        ? Response::allow()
        : Response::deny('You do not have permission to edit properties.');
}
```

## Controllers Updated

### AgentPropertyController ✅
Added `authorizeResource()` in constructor - all CRUD methods now automatically check permissions

## Usage Examples

### In Controllers
```php
// Automatic (recommended)
$this->authorizeResource(AgentProperty::class, 'property');

// Manual
$this->authorize('update', $property);
```

### In Blade Views
```blade
@can('update', $property)
    <button>Edit</button>
@endcan

@cannot('delete', $property)
    <p>You cannot delete this property</p>
@endcannot
```

### In Routes
```php
Route::resource('properties', AgentPropertyController::class)
    ->middleware('can:viewAny,App\Models\AgentProperty');
```

## Testing Policies

```php
public function test_user_can_update_property_with_permission()
{
    $user = User::factory()->create();
    $user->givePermissionTo('edit properties');
    $property = AgentProperty::factory()->create();
    
    $this->assertTrue($user->can('update', $property));
}

public function test_user_cannot_update_property_without_permission()
{
    $user = User::factory()->create();
    $property = AgentProperty::factory()->create();
    
    $this->assertFalse($user->can('update', $property));
}
```

## Future Enhancements

1. **Additional Policies** - Create policies for Blog, Developer, Amenity models
2. **Ownership Checks** - Add logic to check if user owns the resource
3. **Custom Gates** - Define custom authorization gates for complex logic
4. **API Authorization** - Apply policies to API endpoints
5. **Policy Caching** - Cache policy results for performance

## Files Created

- ✅ app/Policies/AgentPropertyPolicy.php
- ✅ app/Policies/DeveloperPropertyPolicy.php
- ✅ app/Policies/CommunityPolicy.php

## Files Modified

- ✅ app/Http/Controllers/Admin/AgentPropertyController.php

## Impact

- **Security:** Improved - Centralized authorization logic
- **Maintainability:** Easier to manage permissions
- **Code Quality:** Cleaner controllers without authorization clutter
- **Breaking Changes:** None - existing permission checks still work
- **Performance:** Minimal impact - policies are lightweight
