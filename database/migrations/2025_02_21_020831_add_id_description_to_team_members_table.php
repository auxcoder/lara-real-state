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
            //
            $table->text('NID')->nullable()->after('languages'); // Adding a new experience field
            $table->text('descripton')->nullable()->after('NID'); // Adding a new experience field

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('team_members', function (Blueprint $table) {
            //
            $table->dropColumn('NID'); // Remove column if rolling back
            $table->dropColumn('descripton'); // Remove column if rolling back

        });
    }
};
