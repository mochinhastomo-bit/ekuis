<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('quiz_attempts', 'user_id')) {
            Schema::table('quiz_attempts', function (Blueprint $table) {
                if ($this->hasForeignKey('quiz_attempts', 'user_id')) {
                    $table->dropForeign(['user_id']);
                }
                $table->dropColumn('user_id');
            });
        }

        if (Schema::hasColumn('quiz_tokens', 'user_id')) {
            Schema::table('quiz_tokens', function (Blueprint $table) {
                if ($this->hasForeignKey('quiz_tokens', 'user_id')) {
                    $table->dropForeign(['user_id']);
                }
                $table->dropColumn('user_id');
            });
        }

        if (Schema::hasTable('quiz_tokens') && !Schema::hasColumn('quiz_tokens', 'mahasiswa_id')) {
            Schema::table('quiz_tokens', function (Blueprint $table) {
                $table->unsignedBigInteger('mahasiswa_id')->nullable()->after('quiz_id');
            });
        }

        if (!Schema::hasColumn('quiz_attempts', 'mahasiswa_id')) {
            Schema::table('quiz_attempts', function (Blueprint $table) {
                $table->unsignedBigInteger('mahasiswa_id')->nullable()->after('quiz_id');
            });
        }

        if (!Schema::hasColumn('quiz_attempts', 'quiz_session_id')) {
            Schema::table('quiz_attempts', function (Blueprint $table) {
                $table->foreignId('quiz_session_id')->nullable()->after('quiz_id')->constrained('quiz_sessions')->nullOnDelete();
            });
        }

        // Remove role and prodi from users if still present
        if (Schema::hasColumn('users', 'role')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('role');
            });
        }

        if (Schema::hasColumn('users', 'prodi')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('prodi');
            });
        }
    }

    private function hasForeignKey(string $table, string $column): bool
    {
        $foreignKeys = Schema::getForeignKeys($table);
        foreach ($foreignKeys as $fk) {
            if (in_array($column, $fk['columns'])) {
                return true;
            }
        }
        return false;
    }

    public function down(): void
    {
        // Not reversible — old columns were already migrated
    }
};
