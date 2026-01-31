<?php

namespace Tests\Feature;

use App\Models\AgentProperty;
use App\Models\Agents;
use App\Models\DeveloperProperty;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PropertyTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_view_agent_properties_list()
    {
        AgentProperty::factory()->count(3)->create();

        $response = $this->get(route('properties.secondarySale'));

        $response->assertStatus(200);
        $response->assertViewHas('properties');
    }

    public function test_can_view_single_property_by_slug()
    {
        $property = AgentProperty::factory()->create(['slug' => 'test-property']);

        $response = $this->get(route('property.details', 'test-property'));

        $response->assertStatus(200);
        $response->assertViewHas('property');
        $response->assertSee($property->name);
    }

    public function test_property_not_found_returns_404()
    {
        $response = $this->get(route('property.details', 'non-existent'));

        $response->assertStatus(404);
    }

    public function test_developer_properties_are_paginated()
    {
        DeveloperProperty::factory()->count(10)->create();

        $response = $this->get(route('offplan'));

        $response->assertStatus(200);
        $response->assertViewHas('properties');
    }
}
