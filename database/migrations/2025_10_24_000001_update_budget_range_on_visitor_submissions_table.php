<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Update budget_range to string to store human-readable labels.
     */
    public function up(): void
    {
        Schema::table('visitor_submissions', function (Blueprint $table) {
            $table->string('budget_range', 255)->nullable()->change();
        });
    }

    /**
     * Revert budget_range back to integer if needed.
     */
    public function down(): void
    {
        Schema::table('visitor_submissions', function (Blueprint $table) {
            $table->string('budget_range', 255)->nullable()->change();
        });
    }
};
