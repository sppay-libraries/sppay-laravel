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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->index();
            $table->string('external_reference')->nullable();
            $table->integer('primary');
            $table->string('status')->index();
            $table->integer('status_id')->index();
            $table->string('type_code');
            $table->string('debit_account_no');
            $table->string('debit_account_name');
            $table->string('debit_account_institution_code');
            $table->string('debit_account_institution_name');
            $table->text('debit_account_institution_logo');
            $table->string('credit_account_institution_code');
            $table->string('credit_account_institution_name');
            $table->text('credit_account_institution_logo');
            $table->decimal('debit_amount', 15);
            $table->string('debit_currency_code');
            $table->string('credit_account_no');
            $table->decimal('credit_amount', 15);
            $table->string('credit_currency_code');
            $table->boolean('is_merchant_settled');
            $table->decimal('tax');
            $table->decimal('commission');
            $table->decimal('charge');
            $table->decimal('rate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
