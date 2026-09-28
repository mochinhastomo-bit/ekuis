<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up(): void
    {
        $password = Hash::make('sandi');
        $now = now();

        $students = [
            ['261103001', 'ZAHRATUN NAHDA ANNAJIYAH'],
            ['261103002', 'KARTIKA SARI DEWI'],
            ['261103003', 'DWI NURHIDAYATI'],
            ['261103004', 'NAYSILLA ANUGERAH FEBRYAPUTRI'],
            ['261103005', 'CHINTIA DEWI'],
            ['261103006', 'RISWANA SEKAR FALISHA'],
            ['261103007', 'FARIHATUS SELFIYAH'],
            ['261103008', 'MUHAMMAD AQILLA SHOLAHUDDIN'],
            ['261103009', 'MARIATUL QIFTYAH'],
            ['261103010', 'REGITA PUTRI AMELIA'],
            ['261103011', 'KARINA DWI MAULIDA'],
            ['261103012', 'SICA FAFA MERISKA'],
            ['261103013', 'ANDHITA GITANAVEZA RETMONO'],
            ['261103014', 'SIGIT DWI HARYO WIBISONO'],
            ['261103015', 'THALITA ALIAVERA ROUDLOTULJANNAH'],
            ['261103016', 'NAZILA TSABITA RAHMAH'],
            ['261103017', 'MEYRIL SUSMULRISKA'],
            ['261103018', 'FAWNIA IFTINAH NAHDAH'],
            ['261103019', 'KESYA MAHESWARI AYU TALIA'],
            ['261103020', 'ANANDA MAYA FEBRIYANTI'],
            ['261103021', 'FIRYAL ALIBRIN RAFIFA INDURASMI NAURA'],
            ['261103022', 'ANISA PUTRI AMELLIA'],
            ['261103048', 'SAFANAH ZAHRAH FIRDAUSY'],
            ['261103049', 'HESHTI FUDLLA'],
            ['261103050', 'RENYTHA FIDLROTUL ULFIYAH'],
            ['261103051', 'SYARIFATUL HIKMAH'],
            ['261103052', 'ANIS ROKHAH HIDAYATI'],
            ['261103053', 'KHAIRUNNISA ZAHROTUL JANNAH'],
            ['261103054', 'NAIMATUS ZAHRO'],
            ['261103055', 'ZUNITA RAHMAH ANGGRAENI'],
            ['261103064', 'NUR DEWI ULYASARI'],
        ];

        foreach ($students as $s) {
            DB::table('users')->updateOrInsert(
                ['nim' => $s[0]],
                [
                    'name' => $s[1],
                    'email' => $s[0] . '@student.local',
                    'prodi' => 'Ilmu Keperawatan',
                    'role' => 'mahasiswa',
                    'password' => $password,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }
    }

    public function down(): void
    {
        $nims = [
            '261103001','261103002','261103003','261103004','261103005',
            '261103006','261103007','261103008','261103009','261103010',
            '261103011','261103012','261103013','261103014','261103015',
            '261103016','261103017','261103018','261103019','261103020',
            '261103021','261103022','261103048','261103049','261103050',
            '261103051','261103052','261103053','261103054','261103055',
            '261103064',
        ];

        DB::table('users')->whereIn('nim', $nims)->delete();
    }
};
