<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class PermissionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'PermissionSeeder']);
    }

    public function test_admin_can_access_amenities_index()
    {
        $admin = User::factory()->create();
        $admin->givePermissionTo('view amenities');

        $response = $this->actingAs($admin)->get(route('amenity.index'));

        $response->assertStatus(200);
    }

    public function test_user_without_permission_cannot_access_amenities()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('amenity.index'));

        $response->assertStatus(403);
    }

    public function test_user_can_create_amenity_with_permission()
    {
        $user = User::factory()->create();
        $user->givePermissionTo('create amenities');

        $response = $this->actingAs($user)->post(route('amenity.store'), [
            'name' => 'Test Amenity',
            'description' => 'Test Description',
            'logo' => null,
        ]);

        $response->assertRedirect();
    }

    public function test_user_cannot_delete_amenity_without_permission()
    {
        $user = User::factory()->create();
        $admin = User::factory()->create();
        $admin->givePermissionTo('create amenities', 'delete amenities');

        $amenity = $this->actingAs($admin)->post(route('amenity.store'), [
            'name' => 'Test',
            'description' => 'Test',
        ]);

        $response = $this->actingAs($user)->delete(route('amenity.destroy', 1));

        $response->assertStatus(403);
    }

    public function test_role_with_permissions_grants_access()
    {
        $role = Role::create(['name' => 'editor']);
        $role->givePermissionTo('view amenities', 'edit amenities');

        $user = User::factory()->create();
        $user->assignRole('editor');

        $response = $this->actingAs($user)->get(route('amenity.index'));

        $response->assertStatus(200);
    }
}
