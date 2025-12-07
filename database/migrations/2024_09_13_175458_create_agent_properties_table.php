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
        Schema::create('agent_properties', function (Blueprint $table) {
            $table->id();

            // These fields are common, while translated fields should go in a separate table
            $table->string('location')->nullable();
            $table->string('property_type')->nullable();
            $table->string('transaction_type')->nullable();

            $table->decimal('price', 12, 2)->nullable();
            $table->decimal('area', 10, 2)->nullable();

            $table->integer('bedrooms')->nullable();
            $table->integer('bathrooms')->nullable();

            $table->string('main_image')->nullable(); // For featured/main image
            $table->enum('status', ['available', 'sold'])->default('available');
            // $table->enum('target_audience', ['UAE', 'International'])->default('UAE');
            // If you don't want timestamps
            // Remove this line if you have no created_at/updated_at
            $table->timestamps();
        });
        Schema::create('property_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained('agent_properties')->onDelete('cascade');
            $table->string('locale')->index(); // 'en', 'ar', etc.
            $table->string('title');
            $table->text('description')->nullable();
            $table->unique(['property_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agent_properties');
        Schema::dropIfExists('property_translations');
    }
};
