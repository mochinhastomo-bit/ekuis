<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $this->safeDropColumn('quiz_attempts', 'user_id');
        $this->safeDropColumn('quiz_tokens', 'user_id');

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

        $this->safeDropColumn('users', 'role');
        $this->safeDropColumn('users', 'prodi');
    }

    private function safeDropColumn(string $table, string $column): void
    {
        if (!Schema::hasColumn($table, $column)) {
            return;
        }

        // Drop foreign keys referencing this column first
        try {
            $foreignKeys = Schema::getForeignKeys($table);
            foreach ($foreignKeys as $fk) {
                if (in_array($column, $fk['columns'])) {
                    Schema::table($table, fn (Blueprint $t) => $t->dropForeign($fk['name']));
                }
            }
        } catch (\Throwable $e) {
            // Ignore — FK may already be gone
        }

        // Drop indexes referencing this column
        try {
            $indexes = Schema::getIndexes($table);
            foreach ($indexes as $index) {
                if (in_array($column, $index['columns']) && !$index['primary']) {
                    Schema::table($table, fn (Blueprint $t) => $t->dropIndex($index['name']));
                }
            }
        } catch (\Throwable $e) {
            // Ignore — index may already be gone
        }

        try {
            Schema::table($table, fn (Blueprint $t) => $t->dropColumn($column));
        } catch (\Throwable $e) {
            // Column may already be gone despite hasColumn returning true
        }
    }

    public function down(): void
    {
        // Not reversible
    }
};
