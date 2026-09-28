<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Create mahasiswas table
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->string('nim', 20)->unique();
            $table->string('name');
            $table->foreignId('prodi_id')->nullable()->constrained('prodis')->nullOnDelete();
            $table->timestamps();
        });

        // 2. Migrate mahasiswa data from users to mahasiswas
        $mahasiswas = DB::table('users')->where('role', 'mahasiswa')->get();
        foreach ($mahasiswas as $mhs) {
            $prodiId = null;
            if ($mhs->prodi) {
                $prodi = DB::table('prodis')->where('nama', $mhs->prodi)->first();
                if ($prodi) {
                    $prodiId = $prodi->id;
                } else {
                    $prodiId = DB::table('prodis')->insertGetId([
                        'nama' => $mhs->prodi,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            DB::table('mahasiswas')->insert([
                'id' => $mhs->id,
                'nim' => $mhs->nim,
                'name' => $mhs->name,
                'prodi_id' => $prodiId,
                'created_at' => $mhs->created_at,
                'updated_at' => $mhs->updated_at,
            ]);
        }

        // 3. Add mahasiswa_id to quiz_tokens and quiz_attempts
        Schema::table('quiz_tokens', function (Blueprint $table) {
            $table->unsignedBigInteger('mahasiswa_id')->nullable()->after('user_id');
        });

        Schema::table('quiz_attempts', function (Blueprint $table) {
            $table->unsignedBigInteger('mahasiswa_id')->nullable()->after('user_id');
        });

        // 4. Copy user_id to mahasiswa_id (same IDs since we preserved them)
        DB::table('quiz_tokens')->update(['mahasiswa_id' => DB::raw('user_id')]);
        DB::table('quiz_attempts')->update(['mahasiswa_id' => DB::raw('user_id')]);

        // 5. Drop old user_id foreign keys and columns, add new foreign keys
        Schema::table('quiz_tokens', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropIndex('quiz_tokens_quiz_id_user_id_unique');
            $table->dropColumn('user_id');
            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswas')->cascadeOnDelete();
            $table->unique(['quiz_id', 'mahasiswa_id']);
        });

        Schema::table('quiz_attempts', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswas')->cascadeOnDelete();
        });

        // 6. Make mahasiswa_id not nullable
        Schema::table('quiz_tokens', function (Blueprint $table) {
            $table->unsignedBigInteger('mahasiswa_id')->nullable(false)->change();
        });

        Schema::table('quiz_attempts', function (Blueprint $table) {
            $table->unsignedBigInteger('mahasiswa_id')->nullable(false)->change();
        });

        // 7. Delete mahasiswa from users table
        DB::table('users')->where('role', 'mahasiswa')->delete();

        // 8. Remove role and prodi columns from users (now dosen only)
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'prodi']);
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('dosen')->after('nim');
            $table->string('prodi')->nullable()->after('nim');
        });

        // Restore mahasiswa to users (simplified - just structure)
        Schema::table('quiz_attempts', function (Blueprint $table) {
            $table->dropForeign(['mahasiswa_id']);
            $table->unsignedBigInteger('user_id')->nullable()->after('quiz_id');
        });

        Schema::table('quiz_tokens', function (Blueprint $table) {
            $table->dropForeign(['mahasiswa_id']);
            $table->dropIndex('quiz_tokens_quiz_id_mahasiswa_id_unique');
            $table->unsignedBigInteger('user_id')->nullable()->after('quiz_id');
        });

        DB::table('quiz_tokens')->update(['user_id' => DB::raw('mahasiswa_id')]);
        DB::table('quiz_attempts')->update(['user_id' => DB::raw('mahasiswa_id')]);

        Schema::table('quiz_tokens', function (Blueprint $table) {
            $table->dropColumn('mahasiswa_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->unique(['quiz_id', 'user_id']);
        });

        Schema::table('quiz_attempts', function (Blueprint $table) {
            $table->dropColumn('mahasiswa_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });

        Schema::dropIfExists('mahasiswas');
    }
};
