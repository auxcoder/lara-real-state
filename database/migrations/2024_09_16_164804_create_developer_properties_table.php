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
        Schema::create('developer_properties', function (Blueprint $table) {
            $table->id();
            $table->integer('developer_id'); // Foreign key to developers table
            $table->string('name');
            // $table->string('location');
            $table->string('status')->default('new'); // e.g., New Launch, Under Construction, Ready to Move, etc.
            // $table->integer('bedrooms')->nullable(); // Number of bedrooms
            // $table->integer('bathrooms')->nullable(); // Number of bathrooms
            $table->decimal('price', 15, 2)->nullable(); // Price in AED
            $table->text('description')->nullable(); // Description of the property
            $table->text('key_highlights')->nullable(); // Description of the property
            $table->json('paymentPlan')->nullable(); // For storing the payment plan details
            $table->string('handover_date')->nullable(); // Handover date or timeline
            $table->string('handover_percentage')->nullable(); // Handover date or timeline
            $table->string('down_percentage')->nullable(); // Handover date or timeline
            $table->string('construction_percentage')->nullable(); // Handover date or timeline
            $table->string('logo')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('community')->nullable();
            $table->string('masterPlan_image')->nullable();
            $table->string('locationMap')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('developer_properties');
    }
};
