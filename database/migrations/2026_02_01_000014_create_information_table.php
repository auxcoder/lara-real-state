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
        Schema::create('information', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('trade_license')->nullable();
            $table->string('emirates_id')->nullable();
            $table->string('passport')->nullable();
            $table->string('bank_account_no')->nullable();
            $table->string('iban_letter')->nullable();
            $table->string('vat_registration_no')->nullable();
            $table->string('contact_person_name')->nullable();
            $table->text('office_address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('information');
    }
};
