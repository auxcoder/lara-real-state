<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('property_gallery_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->string('image');
            $table->timestamps();

            // Foreign key to agent_properties table
            $table->foreign('property_id')->references('id')->on('agent_properties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('property_gallery_images', function (Blueprint $table) {
            $table->dropForeign(['property_id']);
        });

        Schema::dropIfExists('property_gallery_images');
    }
};
