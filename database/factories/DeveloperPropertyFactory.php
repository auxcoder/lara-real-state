<?php

namespace Database\Factories;

use App\Models\Amenity;
use App\Models\Developer;
use App\Models\DeveloperProperty;
use App\Models\FloorPlan;
use App\Models\Location;
use App\Models\MasterPlan;
use App\Models\PropertyType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DeveloperProperty>
 */
class DeveloperPropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $directory = 'public/storage/images';
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        return [
            'developer_id' => Developer::factory(), // Create a related developer
            'name' => $this->faker->company,
            'status' => $this->faker->randomElement(['new', 'under_construction', 'ready_to_move']),
            'price' => $this->faker->randomFloat(2, 100000, 5000000),
            'description' => $this->faker->paragraph,
            'handover_date' => $this->faker->date(),
            'handover_percentage' => $this->faker->randomFloat(2, 0, 100),
            'down_percentage' => $this->faker->randomFloat(2, 0, 100),
            'construction_percentage' => $this->faker->randomFloat(2, 0, 100),
            'community' => $this->faker->city,
            'logo' => 'images/' . $this->faker->image('public/storage/images', 640, 480, null, false),
            'cover_image' => 'images/' . $this->faker->image('public/storage/images', 640, 480, null, false),
            'masterPlan_image' => 'images/' . $this->faker->image('public/storage/images', 640, 480, null, false),
            'locationMap' => 'images/' . $this->faker->image('public/storage/images', 640, 480, null, false),
            'key_highlights' => implode(',', $this->faker->words(rand(3, 7))),
        ];
    }
    public function withRelations()
    {
        return $this->afterCreating(function (DeveloperProperty $developerProperty) {
            // Attach related master plans (random 2 to 5 master plans)
            $masterPlans = MasterPlan::factory()->count(rand(2, 5))->create();
            $developerProperty->masterPlans()->attach($masterPlans);

            // Attach related locations with random distances
            $locations = Location::factory()->count(rand(2, 4))->create();
            foreach ($locations as $location) {
                $developerProperty->locations()->attach($location->id, ['distance' => rand(5, 60)]);
            }

            // Attach related Amenity (random 3 to 6 Amenity)
            $Amenity = Amenity::factory()->count(rand(3, 6))->create();
            $developerProperty->Amenity()->attach($Amenity);

            PropertyType::factory()->count(rand(2, 4))->create([
                'developer_property_id' => $developerProperty->id,
            ]);

            // Create and attach floor plans
            FloorPlan::factory()->count(rand(2, 4))->create([
                'developer_property_id' => $developerProperty->id,
            ]);
        });
    }
}
