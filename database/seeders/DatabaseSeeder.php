<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Amenity;
use App\Models\DeveloperProperty;
use App\Models\Location;
use App\Models\MasterPlan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $roles = [
            'admin',
            'user',
        ];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }


        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => date('Y-m-d h:i:s'),
        ]);

        $user->assignRole('admin');
        $user = User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => date('Y-m-d h:i:s'),
        ]);

        $user->assignRole('user');

        // Location::factory(10)->create();

        // // Create 5 master plans
        // MasterPlan::factory(5)->create();

        // // Create 15 Amenity
        // Amenity::factory(15)->create();
        // DeveloperProperty::factory()
        //     ->withRelations() // This will create and attach master plans, locations, and Amenity
        //     ->count(1)
        //     ->create();
    }
}
