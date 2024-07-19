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
        Schema::create('outgoingletters', function (Blueprint $table) {
            $table->id();
            $table->string('letter_id');
            $table->string('reference_no');
            $table->string('organization_name');
            $table->string('description');
            $table->string('sending_date');
            $table->timestamps();
            $table->softDeletesDatetime();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outgoingletters');
    }
};

