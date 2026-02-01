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
        Schema::create('amenity_developer_property', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('amenity_id')->index();
            $table->unsignedBigInteger('developer_property_id')->index();

            // Foreign keys
            $table->foreign(['amenity_id'])->references(['id'])->on('amenities')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['developer_property_id'])->references(['id'])->on('developer_properties')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amenity_developer_property');
    }
};
