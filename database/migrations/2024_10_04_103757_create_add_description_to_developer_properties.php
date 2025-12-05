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
        Schema::table('developer_properties', function (Blueprint $table) {
            // Add new columns
            $table->text('masterPlan_description')->nullable();
            $table->text('floorPlan_description')->nullable();
            $table->text('locationMap_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('developer_properties', function (Blueprint $table) {
            // Remove the new columns in case of rollback
            $table->dropColumn('masterPlan_description');
            $table->dropColumn('floorPlan_description');
            $table->dropColumn('locationMap_description');
        });
    }

};
