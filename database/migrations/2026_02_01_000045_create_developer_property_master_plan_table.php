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
        Schema::create('developer_property_master_plan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('developer_property_id')->index();
            $table->unsignedBigInteger('masterPlan_id')->index();

            // Foreign keys
            $table->foreign(['developer_property_id'])->references(['id'])->on('developer_properties')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['masterPlan_id'])->references(['id'])->on('master_plans')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('developer_property_master_plan');
    }
};
