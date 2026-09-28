<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('periodes', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique();
            $table->timestamps();
        });

        Schema::create('prodis', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique();
            $table->timestamps();
        });

        Schema::create('matakuliahs', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique();
            $table->timestamps();
        });

        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique();
            $table->timestamps();
        });

        Schema::table('quizzes', function (Blueprint $table) {
            $table->foreignId('periode_id')->nullable()->constrained('periodes')->nullOnDelete();
            $table->foreignId('prodi_id')->nullable()->constrained('prodis')->nullOnDelete();
            $table->foreignId('matakuliah_id')->nullable()->constrained('matakuliahs')->nullOnDelete();
            $table->foreignId('kelas_id')->nullable()->constrained('kelas')->nullOnDelete();
            $table->string('access_code', 6)->nullable();
        });

        // Seed initial data
        DB::table('periodes')->insert([
            ['nama' => '2025-2026 Ganjil', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => '2025-2026 Genap', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => '2026-2027 Ganjil', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('prodis')->insert([
            ['nama' => 'Ilmu Keperawatan', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Psikologi', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Teknik Elektro', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('matakuliahs')->insert([
            ['nama' => 'Aplikasi Komputer', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Arsitektur Sistem Komputer', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Aplikasi Komputer Dasar', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Aplikasi Komputer Lanjut', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('kelas')->insert([
            ['nama' => 'Pagi', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Sore', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::table('quizzes', function (Blueprint $table) {
            $table->dropConstrainedForeignId('periode_id');
            $table->dropConstrainedForeignId('prodi_id');
            $table->dropConstrainedForeignId('matakuliah_id');
            $table->dropConstrainedForeignId('kelas_id');
            $table->dropColumn('access_code');
        });

        Schema::dropIfExists('kelas');
        Schema::dropIfExists('matakuliahs');
        Schema::dropIfExists('prodis');
        Schema::dropIfExists('periodes');
    }
};
