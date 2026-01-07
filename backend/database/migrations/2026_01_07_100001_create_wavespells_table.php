<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wavespells', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('wavespell_number')->unique();
            $table->string('solar_seal');
            $table->string('solar_seal_es');
            $table->string('color');
            $table->string('color_es');
            $table->unsignedInteger('start_kin');
            $table->unsignedInteger('end_kin');
            $table->unsignedInteger('kin_count');
            $table->text('description')->nullable();
            $table->text('description_es')->nullable();
            $table->timestamps();

            $table->index('wavespell_number');
            $table->index('start_kin');
            $table->index('end_kin');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wavespells');
    }
};
