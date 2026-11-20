<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menfess_likes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('menfess_id')
                ->constrained('menfesses')
                ->cascadeOnDelete();

            $table->unique(['user_id', 'menfess_id']);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menfess_likes');
    }
};
