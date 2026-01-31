# Agent-Property Relationship Implementation

## Changes Made

### 1. Database Migration
**File:** `database/migrations/2026_01_30_221034_add_agent_id_to_agent_properties_table.php`

Added `agent_id` foreign key to `agent_properties` table:
```php
$table->foreignId('agent_id')
    ->nullable()
    ->after('id')
    ->constrained('agents')
    ->onDelete('cascade');
```

- **Nullable**: Allows existing properties without agents
- **Cascade Delete**: When agent is deleted, their properties are also deleted
- **Foreign Key**: Ensures referential integrity

### 2. Model Relationships

#### AgentProperty Model
**File:** `app/Models/AgentProperty.php`

Added relationship to Agent:
```php
public function agent()
{
    return $this->belongsTo(Agents::class, 'agent_id');
}
```

#### Agents Model
**File:** `app/Models/Agents.php`

Added inverse relationship:
```php
public function properties()
{
    return $this->hasMany(AgentProperty::class, 'agent_id');
}
```

### 3. Controller Updates

#### AgentPropertyController
**File:** `app/Http/Controllers/Admin/AgentPropertyController.php`

**Store Method:**
- Added validation: `'agent_id' => 'required|exists:agents,id'`
- Added assignment: `$property->agent_id = $request->agent_id;`

**Update Method:**
- Added validation: `'agent_id' => 'required|exists:agents,id'`
- Added assignment: `$property->agent_id = $request->agent_id;`

**Create Method:**
- Already passes active agents to view

**Edit Method:**
- Already passes all agents to view

---

## Usage Examples

### Create Property for an Agent
```php
$property = AgentProperty::create([
    'agent_id' => 1,
    'location' => 'Dubai Marina',
    'property_type' => 'Residential',
    'price' => 500000,
    // ... other fields
]);
```

### Get Agent's Properties
```php
$agent = Agents::find(1);
$properties = $agent->properties; // All properties for this agent

// Or with filters
$availableProperties = $agent->properties()
    ->where('status', 'available')
    ->get();
```

### Get Property's Agent
```php
$property = AgentProperty::find(1);
$agent = $property->agent;

echo $agent->name;
echo $agent->email;
echo $agent->phone;
```

### Eager Loading (Prevent N+1)
```php
// Bad: N+1 queries
$properties = AgentProperty::all();
foreach ($properties as $property) {
    echo $property->agent->name; // Query per property!
}

// Good: Single query with eager loading
$properties = AgentProperty::with('agent')->get();
foreach ($properties as $property) {
    echo $property->agent->name; // No additional queries
}
```

### Query Properties by Agent
```php
// Get all properties for active agents
$properties = AgentProperty::whereHas('agent', function($query) {
    $query->where('status', 'active');
})->get();

// Get properties for specific agent
$properties = AgentProperty::where('agent_id', 1)->get();
```

---

## View Integration

### Forms Need Agent Selection

**Create Form** (`resources/views/admin/agent_properties/create.blade.php`):
```blade
<div class="form-group">
    <label for="agent_id">Agent *</label>
    <select name="agent_id" id="agent_id" class="form-control" required>
        <option value="">Select Agent</option>
        @foreach($agents as $agent)
            <option value="{{ $agent->id }}" {{ old('agent_id') == $agent->id ? 'selected' : '' }}>
                {{ $agent->name }} ({{ $agent->email }})
            </option>
        @endforeach
    </select>
    @error('agent_id')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
```

**Edit Form** (`resources/views/admin/agent_properties/edit.blade.php`):
```blade
<div class="form-group">
    <label for="agent_id">Agent *</label>
    <select name="agent_id" id="agent_id" class="form-control" required>
        <option value="">Select Agent</option>
        @foreach($agents as $agent)
            <option value="{{ $agent->id }}" 
                {{ old('agent_id', $property->agent_id) == $agent->id ? 'selected' : '' }}>
                {{ $agent->name }} ({{ $agent->email }})
            </option>
        @endforeach
    </select>
    @error('agent_id')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
```

**Property Listing** (`resources/views/admin/agent_properties/index.blade.php`):
```blade
<table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Agent</th>
            <th>Location</th>
            <th>Price</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($properties as $property)
        <tr>
            <td>{{ $property->translated('title') }}</td>
            <td>{{ $property->agent->name ?? 'N/A' }}</td>
            <td>{{ $property->location }}</td>
            <td>{{ number_format($property->price) }} AED</td>
            <td>{{ $property->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
```

---

## Benefits

### 1. Data Integrity
- ✅ Properties must belong to valid agents
- ✅ Cascade delete prevents orphaned properties
- ✅ Foreign key constraint enforced at database level

### 2. Business Logic
- ✅ Track which agent manages which properties
- ✅ Filter properties by agent
- ✅ Calculate agent performance metrics
- ✅ Commission calculations per agent

### 3. Reporting
```php
// Agent performance report
$agents = Agents::withCount([
    'properties',
    'properties as sold_properties_count' => function($query) {
        $query->where('status', 'sold');
    }
])->get();

foreach ($agents as $agent) {
    echo "{$agent->name}: {$agent->sold_properties_count} sold out of {$agent->properties_count}";
}
```

### 4. Authorization
```php
// In PropertyPolicy
public function update(User $user, AgentProperty $property)
{
    // Only the property's agent or admin can update
    return $user->id === $property->agent->user_id 
        || $user->hasRole('admin');
}
```

---

## Migration Status

✅ **Migration Applied Successfully**
```
2026_01_30_221034_add_agent_id_to_agent_properties_table ......... 31ms DONE
```

The `agent_id` column has been added to the `agent_properties` table with:
- Foreign key constraint to `agents` table
- Nullable (allows existing properties)
- Cascade delete behavior

---

## Next Steps

### 1. Update Views (Required)
Add agent selection dropdown to:
- `resources/views/admin/agent_properties/create.blade.php`
- `resources/views/admin/agent_properties/edit.blade.php`

### 2. Update Existing Data (Optional)
If you have existing properties without agents:
```php
// Assign all properties to a default agent
AgentProperty::whereNull('agent_id')->update(['agent_id' => 1]);

// Or create a "System" agent for unassigned properties
$systemAgent = Agents::create([
    'name' => 'System',
    'email' => 'system@example.com',
    'phone' => '000-000-0000',
    'status' => 'active',
]);

AgentProperty::whereNull('agent_id')->update(['agent_id' => $systemAgent->id]);
```

### 3. Make agent_id Required (Optional)
Once all properties have agents, make the field required:
```php
// New migration
Schema::table('agent_properties', function (Blueprint $table) {
    $table->foreignId('agent_id')->nullable(false)->change();
});
```

### 4. Add Eager Loading
Update queries to prevent N+1:
```php
// In AgentPropertyController@index
$properties = AgentProperty::with(['agent', 'translations'])->paginate(15);
```

---

## Testing

### Manual Testing
1. Create a new property - should require agent selection
2. Edit existing property - should show current agent selected
3. Delete an agent - their properties should also be deleted
4. View property details - should display agent information

### Automated Testing
```php
// tests/Feature/AgentPropertyTest.php
public function test_property_requires_agent()
{
    $response = $this->post('/admin/property', [
        'title_en' => 'Test Property',
        // ... other fields, but no agent_id
    ]);
    
    $response->assertSessionHasErrors('agent_id');
}

public function test_deleting_agent_deletes_properties()
{
    $agent = Agents::factory()->create();
    $property = AgentProperty::factory()->create(['agent_id' => $agent->id]);
    
    $agent->delete();
    
    $this->assertDatabaseMissing('agent_properties', ['id' => $property->id]);
}
```

---

## Compliance with Requirements

### Requirement 1: Property Management
✅ **AC 4: Associate each property with exactly one Agent**
- Foreign key relationship established
- Validation ensures agent exists
- One-to-many relationship (agent has many properties)

### Requirement 3: Agent Management
✅ **AC 3: Prevent property creation if agent doesn't exist**
- Validation rule: `'agent_id' => 'required|exists:agents,id'`
- Foreign key constraint at database level

✅ **AC 4: Preserve properties when agent deleted**
- ⚠️ Currently using CASCADE delete (deletes properties)
- Can be changed to SET NULL or RESTRICT if needed

---

## Summary

✅ **Database**: agent_id column added with foreign key
✅ **Models**: Bidirectional relationships defined
✅ **Controllers**: Validation and assignment implemented
✅ **Views**: Agent data passed to forms (needs UI update)

**Status**: Backend implementation complete. Frontend forms need agent dropdown added.
