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
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('visitor_name');
            $table->string('contact')->nullable();
            $table->string('department')->nullable();
            $table->string('gender');
            $table->string('vulnerability');
            $table->string('purpose_of_visit');
            $table->string('time_in')->nullable();
            $table->string('time_out')->nullable();
            $table->string('visiting_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};

