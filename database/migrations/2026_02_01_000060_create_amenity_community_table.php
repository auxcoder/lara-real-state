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
        Schema::create('amenity_community', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('community_id')->index();
            $table->unsignedBigInteger('amenity_id')->index();

            // Foreign keys
            $table->foreign(['amenity_id'])->references(['id'])->on('amenities')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['community_id'])->references(['id'])->on('communities')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amenity_community');
    }
};
