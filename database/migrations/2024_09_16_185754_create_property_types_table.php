<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('property_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('developer_property_id')->constrained('developer_properties')->onDelete('cascade');
            $table->string('property_type'); // e.g., Apartment, Villa, Townhouse, etc.
            $table->string('unit_type'); // e.g., Apartment, Villa, Townhouse, etc.
            $table->string('size'); // Size of the property in square feet
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_types');
    }
};
