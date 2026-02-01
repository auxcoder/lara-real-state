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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('agent_id')->nullable()->index();
            $table->string('slug')->nullable()->unique();
            $table->string('location')->nullable()->index();
            $table->string('property_type')->nullable()->index();
            $table->string('transaction_type')->nullable();
            $table->decimal('price', 12)->nullable();
            $table->decimal('area', 10)->nullable();
            $table->integer('bedrooms')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->string('main_image')->nullable();
            $table->enum('status', ['available', 'sold'])->default('available')->index();
            $table->timestamp('created_at')->nullable()->index();
            $table->timestamp('updated_at')->nullable();
            $table->softDeletes();

            // Foreign keys
            $table->foreign(['agent_id'])->references(['id'])->on('agents')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agent_properties');
    }
};
