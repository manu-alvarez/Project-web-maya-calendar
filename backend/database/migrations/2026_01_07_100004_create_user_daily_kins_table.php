<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_daily_kins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('date')->unique();
            $table->unsignedInteger('kin_id');
            $table->unsignedInteger('wavespell_id');
            $table->unsignedInteger('castle_id');
            $table->boolean('is_viewed')->default(false);
            $table->timestamp('viewed_at')->nullable();
            $table->json('oracle_data')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'date']);
            $table->index('kin_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_daily_kins');
    }
};
