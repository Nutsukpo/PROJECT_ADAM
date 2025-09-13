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
        Schema::create('memos', function (Blueprint $table) {
            $table->id();
            $table->string('to');
            $table->string('from');
            $table->string('date');
            $table->string('subject');
            $table->text('body')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->string('currency')->default('GHS');
            $table->string('name_of_employee');
            $table->json('items')->nullable(); // for router, zone, amount etc.
            $table->string('signature')->nullable();
            $table->enum('status', [
                'draft', 'validated', 'confirm', 'review', 'commit', 'processed', 'authorized', 'finalize', 'disbursed', 'credited'
            ])->default('draft')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memos');
    }
};
