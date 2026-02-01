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
        Schema::create('developer_properties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug')->nullable()->unique();
            $table->integer('developer_id')->index();
            $table->string('name');
            $table->string('location');
            $table->string('status')->default('new')->index();
            $table->integer('bedrooms')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->decimal('price', 15)->nullable();
            $table->text('description')->nullable();
            $table->text('key_highlights')->nullable();
            $table->json('paymentPlan')->nullable();
            $table->string('handover_date')->nullable();
            $table->string('handover_percentage')->nullable();
            $table->string('down_percentage')->nullable();
            $table->string('construction_percentage')->nullable();
            $table->string('logo')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('community')->nullable();
            $table->string('masterPlan_image')->nullable();
            $table->string('locationMap')->nullable();
            $table->timestamp('created_at')->nullable()->index();
            $table->timestamp('updated_at')->nullable();
            $table->text('masterPlan_description')->nullable();
            $table->text('floorPlan_description')->nullable();
            $table->text('locationMap_description')->nullable();
            $table->softDeletes();
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
