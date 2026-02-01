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
        Schema::create('floor_plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('developer_property_id')->index();
            $table->string('category')->nullable();
            $table->string('unit_type')->nullable();
            $table->string('floor_details')->nullable();
            $table->string('sizes')->nullable();
            $table->string('type')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign(['developer_property_id'])->references(['id'])->on('developer_properties')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('floor_plans');
    }
};
