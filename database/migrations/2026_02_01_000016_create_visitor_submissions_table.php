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
        Schema::create('visitor_submissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email');
            $table->string('phone_number');
            $table->string('nationality');
            $table->string('property_type')->nullable();
            $table->text('specifications')->nullable();
            $table->string('preferred_location')->nullable();
            $table->string('budget_range')->nullable();
            $table->enum('payment_for_rent', ['Personal', 'Company']);
            $table->unsignedInteger('number_of_family_members')->nullable();
            $table->string('passport_pdf');
            $table->string('emirates_id_pdf');
            $table->string('bank_statement_pdf');
            $table->string('trade_license_pdf')->nullable();
            $table->string('vat_registration_certificate_pdf')->nullable();
            $table->string('etihad_credit_bureau_pdf')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitor_submissions');
    }
};
