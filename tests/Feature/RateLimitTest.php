<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RateLimitTest extends TestCase
{
    use RefreshDatabase;

    public function test_complaint_form_is_rate_limited()
    {
        // Make 6 requests (limit is 5 per minute)
        for ($i = 0; $i < 6; $i++) {
            $response = $this->post(route('complaint.submit'), [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'phone_number' => '1234567890',
                'email' => 'test@example.com',
                'building_villa' => 'Building A',
                'flat_no' => '101',
                'complaints' => ['maintenance'],
                'complaint_details' => 'Test complaint',
            ]);

            if ($i < 5) {
                $response->assertStatus(302); // Redirect on success
            } else {
                $response->assertStatus(429); // Too Many Requests
            }
        }
    }

    public function test_visitor_form_is_rate_limited()
    {
        for ($i = 0; $i < 6; $i++) {
            $response = $this->post(route('visitor.submit'), [
                'name' => 'Test User',
                'email' => 'test@example.com',
                'phone_number' => '1234567890',
                'nationality' => 'US',
                'payment_for_rent' => 'monthly',
            ]);

            if ($i >= 5) {
                $response->assertStatus(429);
            }
        }
    }
}
