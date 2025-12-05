<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('developer_property_masterPlan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('developer_property_id')->constrained()->onDelete('cascade');
            $table->foreignId('masterPlan_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('developer_property_masterPlan');
    }
};
