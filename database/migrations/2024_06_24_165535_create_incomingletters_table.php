<?php

use Illuminate\Database\Eloquent\SoftDeletes;
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
        Schema::create('incomingletters', function (Blueprint $table) {
            $table->id();
            $table->string('letter_id');
            $table->string('reference_no');
            $table->string('organization_name');
            $table->string('description');
            $table->string('receiving_date');
            $table->string('to_whom_received');
            $table->string('date_of_letter');
            $table->string('sender');
            $table->string('mode_of_letter');
            $table->string('name_of_person_receiving');

            $table->timestamps();
            $table->softDeletesDatetime();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incomingletters');
    }
};

