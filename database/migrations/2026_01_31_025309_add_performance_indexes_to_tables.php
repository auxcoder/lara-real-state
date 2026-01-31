<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('agent_properties', function (Blueprint $table) {
            $table->index('agent_id');
            $table->index('status');
            $table->index('property_type');
            $table->index('location');
            $table->index('created_at');
        });

        Schema::table('developer_properties', function (Blueprint $table) {
            $table->index('developer_id');
            $table->index('status');
            $table->index('created_at');
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->index('created_at');
        });

        Schema::table('agents', function (Blueprint $table) {
            $table->index('created_at');
        });

        Schema::table('developers', function (Blueprint $table) {
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::table('agent_properties', function (Blueprint $table) {
            $table->dropIndex(['agent_id']);
            $table->dropIndex(['status']);
            $table->dropIndex(['property_type']);
            $table->dropIndex(['location']);
            $table->dropIndex(['created_at']);
        });

        Schema::table('developer_properties', function (Blueprint $table) {
            $table->dropIndex(['developer_id']);
            $table->dropIndex(['status']);
            $table->dropIndex(['created_at']);
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->dropIndex(['created_at']);
        });

        Schema::table('agents', function (Blueprint $table) {
            $table->dropIndex(['created_at']);
        });

        Schema::table('developers', function (Blueprint $table) {
            $table->dropIndex(['created_at']);
        });
    }
};
