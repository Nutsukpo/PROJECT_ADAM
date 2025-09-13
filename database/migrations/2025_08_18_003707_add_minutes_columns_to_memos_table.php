<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('memos', function (Blueprint $table) {
            $table->string('minute_to')->nullable()->after('signature');
            $table->text('minutes')->nullable()->after('minute_to');
            $table->date('minute_date')->nullable()->after('minutes');
            $table->string('minute_signature')->nullable()->after('minute_date');
        });
    }

    public function down()
    {
        Schema::table('memos', function (Blueprint $table) {
            $table->dropColumn(['minute_to', 'minutes', 'minute_date', 'minute_signature']);
        });
    }
};