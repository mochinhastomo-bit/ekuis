<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up(): void
    {
        $password = Hash::make('elektro25');
        $now = now();

        $students = [
            ['250603004', 'MUHAMMAD ABI PRATAMA'],
            ['250603009', 'ADRYAN WILDAN MAULANA'],
            ['250603010', 'RIFQI FATHIN PRATAMA'],
            ['250603011', 'KIKI SETYAWAN'],
            ['250603016', 'MUAMMAR AL HAFID HABIBULLAH'],
            ['250603019', 'ACHMAD RAFFY PRATAMA PUTRA'],
            ['250603025', 'SURYO PANJI BUMANTORO'],
            ['250603026', 'MUHAMMAD SYAIFUL RAHMAN'],
            ['250603027', 'MUHAMMAD NAJIB RAFI'],
            ['250603028', 'AHMAD ARIEL ALFANDO'],
            ['250603032', 'ACHMAD BAIHAQI SYAIBIL'],
            ['250603033', 'MUHAMMAD AFRIZAL MUTTAQIN'],
            ['250603034', 'MUHAMMAD EQY RAHMANSYAH'],
            ['250603036', 'AKBAR ANTON PRASETYO'],
            ['250603037', 'MUHAMMAD RAFIF ALFAIRUZ'],
            ['250603038', 'ARYA FIQIH DIDRA'],
            ['250603040', 'MOCH.AFIF HARYONO SETIAWAN'],
            ['250603044', 'ACHMAD SHOLIH HAKIM'],
            ['250603047', 'ACHMAD DEVANKA DWI PRAYOGA'],
            ['250603055', 'MUHAMMAD RASYID MAULANA'],
            ['250603057', 'BILALI DJAMAL'],
            ['250603059', 'MOHAMAD ALFIN NUR SIFAK'],
            ['250603060', 'MUHAMMAD RIFQI PRATAMA'],
            ['250603061', 'MUHAMMAD HAFID JIDDAN'],
            ['250603062', 'MUHAMMAD RIZKY ARDHIANSYAH'],
            ['250603064', 'MOCHAMAD WAHYU RIZKY AGUSTIAN'],
            ['250603065', 'MUHAMMAD KAMALUDDIN FIRDAUS'],
            ['250603066', 'MUHAMMAD FATCHUL ICHYAK'],
            ['250603067', 'HANIF AFIFUDIN ARSYADI'],
            ['250603068', 'AHMAD AFSAR IRSYADI'],
            ['250603069', 'FERY DWI PRASETYO'],
            ['250603070', 'ACHMAD ARIF MUHADI'],
            ['250603071', 'MUHAMMAD AINUL YAQIN'],
            ['250603072', 'MOH NURUL BADRID TAMAMI'],
            ['250603073', 'RAVINO SATRIA PRAWONO'],
            ['250603075', 'RADIT FERDIANSAH'],
            ['250603076', 'MUHAMMAD KEMAL ASHSHAIBI'],
            ['240603015', 'ABDUL AZIS'],
            ['250603001', 'MUHAMMAD ADAM AL FARIZY'],
            ['250603005', 'GUSTI DWI SANDI'],
            ['250603006', 'M HAIDAR SALMAN'],
            ['250603007', 'MUCHAMMAD IKHDAN NIZAR'],
            ['250603008', 'ACH ZIA MUSTHOFA'],
            ['250603012', 'MUHAMMAD DHIKA FISABILILLAH'],
            ['250603013', 'TIO SAPUTRA'],
            ['250603014', 'RADITYA EZRA WIRA WIBOWO'],
            ['250603015', 'SHEVA NAURA CIESA RAMADHAN'],
            ['250603017', 'RAMA DHANI HIRMAN SAPUTRA'],
            ['250603018', 'MUHAMMAD GILANG MAULANA'],
            ['250603020', 'FACHRIZA ADITYA RACHMAN'],
            ['250603021', 'NUR AHMAD DANDHI MARDIYANTO'],
            ['250603022', 'ADHEN BINTANG HARSETYA S.'],
            ['250603023', 'ESA FEBRIANTO HARIADI'],
            ['250603024', 'MUHAMMAD YUSUF ARDILAH'],
            ['250603029', 'FAREL DWI HERMANSYAH'],
            ['250603030', 'RAFAEL IQBAL AL-KAUTSAR'],
            ['250603031', 'MOHAMMAD FAHMI AMHAR'],
            ['250603035', 'AHMAD \'IZZUDDIN AL AKROM'],
            ['250603039', 'RAHFI DHUHURYANDI'],
            ['250603042', 'AHMAD DWI HULUKIL FIRDAUS'],
            ['250603048', 'FERI ADI FIRMANSAH'],
            ['250603049', 'RAFIDAH AL KHARIS'],
            ['250603058', 'BAGUS SURYA'],
            ['260603072', 'HERI YS'],
        ];

        foreach ($students as $s) {
            DB::table('users')->updateOrInsert(
                ['nim' => $s[0]],
                [
                    'name' => $s[1],
                    'email' => $s[0] . '@student.local',
                    'prodi' => 'Teknik Elektro',
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
            '250603004','250603009','250603010','250603011','250603016',
            '250603019','250603025','250603026','250603027','250603028',
            '250603032','250603033','250603034','250603036','250603037',
            '250603038','250603040','250603044','250603047','250603055',
            '250603057','250603059','250603060','250603061','250603062',
            '250603064','250603065','250603066','250603067','250603068',
            '250603069','250603070','250603071','250603072','250603073',
            '250603075','250603076','240603015','250603001','250603005',
            '250603006','250603007','250603008','250603012','250603013',
            '250603014','250603015','250603017','250603018','250603020',
            '250603021','250603022','250603023','250603024','250603029',
            '250603030','250603031','250603035','250603039','250603042',
            '250603048','250603049','250603058','260603072',
        ];

        DB::table('users')->whereIn('nim', $nims)->delete();
    }
};
