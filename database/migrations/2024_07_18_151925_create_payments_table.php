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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('voucher_id');
            $table->string('payment_date');
            $table->string('name_of_employee');
            $table->string('month_of_payment');
            $table->string('payment_amount');
            $table->string('purpose_of_payment'); 
            $table->timestamps();
            $table->softDeletesDatetime();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
