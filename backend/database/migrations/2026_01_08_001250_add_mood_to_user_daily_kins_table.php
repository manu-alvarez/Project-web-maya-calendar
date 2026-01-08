<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_daily_kins', function (Blueprint $table) {
            $table->string('mood')->nullable()->after('notes');
        });
    }

    public function down(): void
    {
        Schema::table('user_daily_kins', function (Blueprint $table) {
            $table->dropColumn('mood');
        });
    }
};
