<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_oracle_readings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('kin_id');
            $table->json('oracle_data');
            $table->text('interpretation')->nullable();
            $table->boolean('is_favorite')->default(false);
            $table->timestamps();

            $table->index(['user_id', 'kin_id']);
            $table->index('is_favorite');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_oracle_readings');
    }
};
