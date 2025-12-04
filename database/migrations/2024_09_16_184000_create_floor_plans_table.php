<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('floorPlans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('developer_property_id')->constrained()->onDelete('cascade'); // Foreign key to developer_properties
            $table->string('category')->nullable(); // e.g., 'Typical Floor Plan'
            $table->string('unit_type')->nullable(); // e.g., 'Layout Plan'
            $table->string('floor_details')->nullable(); // e.g., '1st, 3rd & 5th Floor to Rooftop Floor'
            $table->string('sizes')->nullable(); // e.g., '0.00 Sq meter to 0.00 Sq meter'
            $table->string('type')->nullable(); // e.g., 'Apartment'
            $table->string('image')->nullable(); // e.g., 'Apartment'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('floorPlans');
    }
};
