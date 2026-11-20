<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menfesses', function (Blueprint $table) {
            $table->id();

            // Pengguna yang membuat menfess
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // Isi menfess
            $table->string('category');
            $table->text('content');

            // Identitas publik atau anonim
            $table->boolean('is_anonymous')->default(true);

            // Status moderasi admin
            $table->enum('status', [
                'pending',
                'approved',
                'rejected',
            ])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menfesses');
    }
};
