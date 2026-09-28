<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('quiz_sessions')) {
            return;
        }

        Schema::create('quiz_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->boolean('is_active')->default(true);
            $table->timestamp('started_at')->nullable();
            $table->timestamp('ended_at')->nullable();
            $table->timestamps();
        });

        Schema::table('quiz_attempts', function (Blueprint $table) {
            $table->foreignId('quiz_session_id')->nullable()->after('quiz_id')->constrained('quiz_sessions')->nullOnDelete();
        });

        Schema::table('quiz_tokens', function (Blueprint $table) {
            $table->dropColumn('used_at');
        });
    }

    public function down(): void
    {
        Schema::table('quiz_tokens', function (Blueprint $table) {
            $table->timestamp('used_at')->nullable();
        });

        Schema::table('quiz_attempts', function (Blueprint $table) {
            $table->dropForeign(['quiz_session_id']);
            $table->dropColumn('quiz_session_id');
        });

        Schema::dropIfExists('quiz_sessions');
    }
};
