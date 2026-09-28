<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quiz_tokens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('token', 8);
            $table->timestamp('used_at')->nullable();
            $table->timestamps();

            $table->unique(['quiz_id', 'user_id']);
            $table->index(['quiz_id', 'token']);
        });

        Schema::table('quizzes', function (Blueprint $table) {
            $table->dropColumn('access_code');
        });
    }

    public function down(): void
    {
        Schema::table('quizzes', function (Blueprint $table) {
            $table->string('access_code', 6)->nullable();
        });

        Schema::dropIfExists('quiz_tokens');
    }
};
