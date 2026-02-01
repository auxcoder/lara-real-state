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
        Schema::create('property_gallery_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('property_id')->index();
            $table->string('image');
            $table->timestamps();

            // Foreign keys
            $table->foreign(['property_id'])->references(['id'])->on('agent_properties')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_gallery_images');
    }
};
