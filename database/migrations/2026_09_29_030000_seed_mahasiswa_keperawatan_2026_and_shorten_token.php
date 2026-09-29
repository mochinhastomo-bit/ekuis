<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Clear existing tokens first (8 digits won't fit in 4)
        DB::table('mahasiswas')->whereNotNull('token')->update(['token' => null]);

        // 2. Shorten token column from 8 to 4 chars
        Schema::table('mahasiswas', function (Blueprint $table) {
            $table->string('token', 4)->nullable()->change();
        });

        // 2. Seed Ilmu Keperawatan 2026 students
        $prodiId = DB::table('prodis')->where('nama', 'like', '%Keperawatan%')->value('id');

        $mahasiswas = [
            ['nim' => '261103023', 'name' => 'KARTIKA EKA HARDIYANTI'],
            ['nim' => '261103024', 'name' => 'NUR AFIFA FEBRILIANI'],
            ['nim' => '261103025', 'name' => 'DELA FRANSISKA INDAH PUTRI'],
            ['nim' => '261103026', 'name' => 'NANDA NUHA NADZIFA'],
            ['nim' => '261103027', 'name' => 'VERA DWI ARTIKA AGUSTINA'],
            ['nim' => '261103028', 'name' => 'ANI RAHAYU NINGSIH'],
            ['nim' => '261103029', 'name' => 'KHAEDIR SYIFAAUL QALBI'],
            ['nim' => '261103030', 'name' => "NAZWA NADA A'ZAMSABILLAH"],
            ['nim' => '261103031', 'name' => 'ADECA APRILLIA CAHYANI PUTRI'],
            ['nim' => '261103032', 'name' => 'MUHAMMAD NACHRUL ILMI'],
            ['nim' => '261103033', 'name' => 'ZAHRA AULIA SYAHRANNI'],
            ['nim' => '261103034', 'name' => 'ANANDA OCTAVIA FITRIANA'],
            ['nim' => '261103035', 'name' => 'THALITA ALINE HASNAH LABIBAH'],
            ['nim' => '261103036', 'name' => 'NUR AZIZAH NOVI'],
            ['nim' => '261103037', 'name' => 'DEWI CANDRA KIRANA'],
            ['nim' => '261103038', 'name' => 'FARAISYA RIFQIA RACHIELIL ADHA'],
            ['nim' => '261103039', 'name' => 'SYAFIRA SUHAILLAH'],
            ['nim' => '261103040', 'name' => 'SHINTA NURIYAH AL FATINA'],
            ['nim' => '261103041', 'name' => 'PUTRI FADJAR HARIANTI AZIZAH'],
            ['nim' => '261103042', 'name' => 'RISHA PUTRI ARIESTA'],
            ['nim' => '261103043', 'name' => 'ISYA MUBAROK'],
            ['nim' => '261103044', 'name' => 'ANZELIFATIN NAJMATUS SHOLIHAH'],
            ['nim' => '261103056', 'name' => 'KHANSA TANIA AQILA'],
            ['nim' => '261103057', 'name' => 'BUNGA RIANA DWI TIARA'],
            ['nim' => '261103058', 'name' => 'SHOFA FIKRIYAH ROMADHONA'],
            ['nim' => '261103059', 'name' => 'PUTRI WULAN ROMADHONI'],
            ['nim' => '261103060', 'name' => 'ISMAUL KHOFIFAH'],
            ['nim' => '261103061', 'name' => 'SINTIA DWI KHOIRIA'],
            ['nim' => '261103062', 'name' => 'HERA NUR FITRIANI'],
            ['nim' => '261103063', 'name' => 'BOU SREYNAN'],
        ];

        $now = now();
        foreach ($mahasiswas as $mhs) {
            DB::table('mahasiswas')->insertOrIgnore([
                'nim' => $mhs['nim'],
                'name' => $mhs['name'],
                'prodi_id' => $prodiId,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }

    public function down(): void
    {
        Schema::table('mahasiswas', function (Blueprint $table) {
            $table->string('token', 8)->nullable()->change();
        });

        DB::table('mahasiswas')->whereIn('nim', [
            '261103023','261103024','261103025','261103026','261103027','261103028',
            '261103029','261103030','261103031','261103032','261103033','261103034',
            '261103035','261103036','261103037','261103038','261103039','261103040',
            '261103041','261103042','261103043','261103044','261103056','261103057',
            '261103058','261103059','261103060','261103061','261103062','261103063',
        ])->delete();
    }
};
