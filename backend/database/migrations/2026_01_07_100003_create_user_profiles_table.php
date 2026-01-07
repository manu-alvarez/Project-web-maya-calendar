<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('birth_kin')->nullable();
            $table->unsignedInteger('tone_of_birth')->nullable();
            $table->string('solar_seal_of_birth')->nullable();
            $table->string('color_of_birth')->nullable();
            $table->string('oracle_guide')->nullable();
            $table->string('oracle_analog')->nullable();
            $table->string('oracle_antipode')->nullable();
            $table->string('oracle_occult')->nullable();
            $table->json('preferences')->nullable();
            $table->timestamps();

            $table->index('user_id');
            $table->index('birth_kin');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
