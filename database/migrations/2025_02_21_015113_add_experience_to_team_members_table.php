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
        Schema::table('team_members', function (Blueprint $table) {
            $table->text('experience')->nullable()->after('description'); // Adding a new experience field
            $table->text('languages')->nullable()->after('experience'); // Adding a new experience field

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('team_members', function (Blueprint $table) {
            //
            $table->dropColumn('experience'); // Remove column if rolling back
            $table->dropColumn('languages'); // Remove column if rolling back
        });
    }
};
