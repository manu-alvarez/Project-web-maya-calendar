<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kins', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('kin_number')->unique();
            $table->string('solar_seal');
            $table->string('solar_seal_es');
            $table->unsignedInteger('galactic_tone');
            $table->string('galactic_tone_name');
            $table->string('color');
            $table->string('color_es');
            $table->string('power');
            $table->string('power_es');
            $table->string('action');
            $table->string('action_es');
            $table->string('essence');
            $table->string('essence_es');
            $table->text('description')->nullable();
            $table->text('description_es')->nullable();
            $table->boolean('is_gap')->default(false);
            $table->boolean('is_core_day')->default(false);
            $table->unsignedInteger('wavespell_id');
            $table->unsignedInteger('castle_id');
            $table->timestamps();

            $table->index('kin_number');
            $table->index('wavespell_id');
            $table->index('castle_id');
            $table->index('is_gap');
            $table->index('is_core_day');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kins');
    }
};
