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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable(); // path to uploaded file
            $table->enum('target_audience', ['UAE', 'International'])->default('UAE');
            $table->timestamps();
        });
        Schema::create('blog_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blog_id')->constrained()->onDelete('cascade');
            $table->string('locale'); // e.g. 'en', 'ar'
            $table->string('title');
            $table->string('slug')->nullable();
            $table->text('description');

            $table->unique(['blog_id', 'locale']); // to prevent duplicate language entries per blog
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
        Schema::dropIfExists('blog_translations');
    }
};
