<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $userId = DB::table('users')->where('role', 'dosen')->value('id');

        $quizId = DB::table('quizzes')->insertGetId([
            'user_id' => $userId,
            'title' => 'Pengantar Sistem Komputer & Memori',
            'description' => 'Soal Pengantar Sistem Komputer dan Memori Komputer',
            'code' => '7FA9AX',
            'is_active' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $questions = [
            ['Menurut Donald H. Sanders (1985), komputer adalah sistem elektronik yang berfungsi untuk...', 25, ['Menyimpan file saja', 'Memanipulasi data secara cepat dan tepat', 'Menampilkan gambar', 'Menghubungkan jaringan'], 1],
            ['Menurut Jogiyanto HM (1992), program pada komputer biasanya tersimpan di...', 25, ['Hardisk eksternal', 'Flashdisk', 'Memori komputer (stored program)', 'CD-ROM'], 2],
            ['Sistem komputer terdiri atas tiga elemen dasar, yaitu...', 25, ['Input, proses, output', 'Hardware, software, brainware', 'RAM, ROM, CPU', 'Monitor, keyboard, mouse'], 1],
            ['Perangkat keras (hardware) komputer meliputi komponen...', 25, ['Sistem operasi dan bahasa pemrograman', 'Input, CPU, output, dan media penyimpanan', 'Programmer dan operator', 'Browser dan aplikasi'], 1],
            ['Perangkat lunak (software) komputer merupakan...', 25, ['Komponen fisik komputer', 'Serangkaian instruksi yang mengatur operasi hardware', 'Orang yang mengoperasikan komputer', 'Kabel dan konektor'], 1],
            ['Yang termasuk dalam perangkat lunak komputer adalah...', 25, ['Monitor dan printer', 'Sistem operasi dan bahasa pemrograman', 'Keyboard dan mouse', 'RAM dan hardisk'], 1],
            ['Bahasa pemrograman tingkat tinggi termasuk dalam kategori...', 25, ['Hardware', 'Software', 'Brainware', 'Firmware'], 1],
            ['Brainware dalam sistem komputer adalah...', 25, ['Perangkat keras tambahan', 'Personal yang terlibat dalam sistem komputer', 'Perangkat lunak sistem', 'Memori komputer'], 1],
            ['Programmer dalam brainware bertugas sebagai...', 25, ['Menjalankan sistem', 'Pembuat dan perancang program', 'Mengelola jaringan', 'Memperbaiki hardware'], 1],
            ['Administrator dalam brainware bertugas untuk...', 25, ['Membuat program', 'Menjalankan dan mengelola suatu sistem', 'Mendesain tampilan', 'Memproduksi hardware'], 1],
            ['Operator dalam brainware bertugas untuk...', 25, ['Merancang program', 'Menjalankan sistem dan peralatan komputer', 'Membuat database', 'Mendesain jaringan'], 1],
            ['Salah satu manfaat komputer dalam bidang pendidikan adalah...', 25, ['Alat kendali mesin', 'Sarana penunjang pendidikan', 'Media hiburan', 'Lahan usaha'], 1],
            ['Komputer sebagai media komunikasi digunakan untuk...', 25, ['Bermain game', 'Berkomunikasi jarak jauh', 'Menghitung angka', 'Mencetak dokumen'], 1],
            ['Komputer sebagai media informasi berfungsi untuk...', 25, ['Mengendalikan mesin industri', 'Menyediakan dan mengakses informasi', 'Menyimpan barang', 'Menghasilkan listrik'], 1],
            ['Komputer sebagai alat kendali digunakan dalam bidang...', 25, ['Hiburan', 'Industri dan otomasi', 'Pendidikan', 'Komunikasi'], 1],
            ['CPU merupakan singkatan dari...', 25, ['Computer Personal Unit', 'Central Processing Unit', 'Central Program Utility', 'Computer Processing Unit'], 1],
            ['Yang BUKAN termasuk elemen dasar sistem komputer adalah...', 25, ['Hardware', 'Software', 'Brainware', 'Netware'], 3],
            ['Bahasa mesin termasuk dalam kategori...', 25, ['Hardware', 'Software', 'Brainware', 'Peripheral'], 1],
            ['Bahasa Query termasuk dalam jenis perangkat lunak...', 25, ['Sistem operasi', 'Bahasa pemrograman', 'Hardware', 'Firmware'], 1],
            ['Komputer sebagai lahan usaha dapat dimanfaatkan untuk...', 25, ['Mengendalikan robot', 'Bisnis online dan e-commerce', 'Bermain game', 'Menonton film'], 1],
            ['Komputer yang digunakan untuk menonton film dan bermain game merupakan manfaat sebagai...', 25, ['Media komunikasi', 'Media informasi', 'Media hiburan', 'Alat kendali'], 2],
            ['Input pada sistem komputer berfungsi untuk...', 25, ['Menampilkan hasil', 'Memasukkan data ke komputer', 'Menyimpan data', 'Memproses data'], 1],
            ['Output pada sistem komputer berfungsi untuk...', 25, ['Memasukkan data', 'Menampilkan hasil pengolahan data', 'Menyimpan program', 'Menghapus data'], 1],
            ['Media penyimpan (memory) pada komputer berfungsi untuk...', 25, ['Memasukkan data', 'Menampilkan data', 'Menyimpan data dan informasi', 'Mencetak data'], 2],
            ['Sistem operasi termasuk dalam jenis...', 25, ['Hardware', 'Software', 'Brainware', 'Peripheral'], 1],
            ['Contoh perangkat input komputer adalah...', 25, ['Monitor dan printer', 'Keyboard dan mouse', 'Speaker dan headphone', 'Hardisk dan flashdisk'], 1],
            ['Contoh perangkat output komputer adalah...', 25, ['Keyboard dan scanner', 'Monitor dan printer', 'Mouse dan joystick', 'Webcam dan microphone'], 1],
            ['Komputer dapat mempermudah pekerjaan karena...', 25, ['Harganya murah', 'Mampu mengolah data secara cepat dan otomatis', 'Ukurannya kecil', 'Tidak membutuhkan listrik'], 1],
            ['Stored program pada komputer berarti...', 25, ['Program tersimpan di internet', 'Program tersimpan di memori komputer', 'Program tersimpan di kertas', 'Program tidak perlu disimpan'], 1],
            ['Tanpa software, hardware komputer...', 25, ['Tetap bisa bekerja normal', 'Tidak dapat berfungsi', 'Bekerja lebih cepat', 'Menjadi lebih mahal'], 1],
            ['Memory pada komputer berfungsi sebagai...', 25, ['Alat input data', 'Media penyimpan data dan informasi', 'Alat output data', 'Pengatur daya listrik'], 1],
            ['Memory terletak di dalam...', 25, ['Monitor', 'Keyboard', 'CPU (Central Processing Unit)', 'Printer'], 2],
            ['Semakin besar kapasitas memori, maka...', 25, ['Komputer semakin lambat', 'Semakin banyak data yang dapat diolah', 'Komputer semakin kecil', 'Tidak berpengaruh'], 1],
            ['RAM bersifat penyimpanan...', 25, ['Permanen', 'Sementara (volatile)', 'Semi permanen', 'Tidak bisa dihapus'], 1],
            ['Hardisk bersifat penyimpanan...', 25, ['Sementara', 'Permanen', 'Hanya bisa dibaca', 'Volatile'], 1],
            ['Memory bekerja dengan menyimpan dan menyuplai data penting yang dibutuhkan oleh...', 25, ['Monitor', 'Keyboard', 'Processor', 'Printer'], 2],
            ['Tanpa memori, komputer hanya berfungsi sebagai...', 25, ['Alat komunikasi', 'Piranti pemroses sinyal digital saja', 'Media penyimpan', 'Alat cetak'], 1],
            ['Primary memory adalah memori yang...', 25, ['Tidak bisa diakses CPU', 'Dapat diakses langsung oleh CPU', 'Hanya untuk menyimpan file', 'Berada di luar komputer'], 1],
            ['Yang termasuk primary memory adalah...', 25, ['Hardisk dan flashdisk', 'RAM, ROM, dan cache memory', 'CD dan DVD', 'USB dan SD Card'], 1],
            ['RAM merupakan singkatan dari...', 25, ['Read Access Memory', 'Random Access Memory', 'Read All Memory', 'Random All Memory'], 1],
            ['Data yang tersimpan di RAM akan hilang ketika...', 25, ['Komputer di-restart atau dimatikan', 'File disalin', 'Aplikasi dibuka', 'Komputer terhubung internet'], 0],
            ['ROM merupakan singkatan dari...', 25, ['Random Only Memory', 'Read Only Memory', 'Read Open Memory', 'Run Only Memory'], 1],
            ['Isi ROM secara default...', 25, ['Bisa diubah pengguna', 'Sudah disediakan dari pabrik dan tidak bisa diubah', 'Kosong saat dibeli', 'Selalu berubah'], 1],
            ['ROM berbentuk sebuah sirkuit yang ditanamkan di...', 25, ['RAM', 'Hardisk', 'Motherboard', 'Monitor'], 2],
            ['ROM dapat bekerja ketika komputer dalam keadaan...', 25, ['Hidup saja', 'Mati saja', 'Mati ataupun hidup', 'Hanya saat booting'], 2],
            ['Cache memory berfungsi untuk...', 25, ['Menyimpan data permanen', 'Menyimpan instruksi sebelum diberikan ke memori utama', 'Menampilkan gambar', 'Menghubungkan ke internet'], 1],
            ['Cache memory pada umumnya ditempatkan di dalam...', 25, ['Hardisk', 'Flashdisk', 'CPU', 'Monitor'], 2],
            ['Adanya cache memory membuat komputer dapat...', 25, ['Menyimpan lebih banyak file', 'Menemukan informasi dan mengekstraksi data lebih cepat', 'Terhubung ke internet', 'Mencetak lebih cepat'], 1],
            ['Memori sekunder berfungsi sebagai...', 25, ['Memori utama', 'Penyimpan permanen untuk membantu fungsi RAM', 'Pengganti CPU', 'Alat input'], 1],
            ['Yang termasuk memori sekunder adalah...', 25, ['RAM dan ROM', 'Hardisk dan flashdisk', 'Cache dan register', 'BIOS dan CMOS'], 1],
            ['DRAM merupakan singkatan dari...', 25, ['Direct Random Access Memory', 'Dynamic Random Access Memory', 'Double Random Access Memory', 'Data Random Access Memory'], 1],
            ['Data pada DRAM harus disegarkan secara berkala oleh...', 25, ['RAM', 'ROM', 'CPU', 'Hardisk'], 2],
            ['DRAM hanya memerlukan komponen per bit berupa...', 25, ['Dua transistor', 'Satu transistor dan kapasitor', 'Tiga kapasitor', 'Satu resistor'], 1],
            ['EDORAM merupakan singkatan dari...', 25, ['Extended Data Output Random Access Memory', 'Electronic Data Out Random Access Memory', 'Extra Data Output RAM', 'External Dynamic Output RAM'], 0],
            ['Keunggulan EDORAM dibanding FPM RAM adalah...', 25, ['Harganya lebih murah', 'Dapat menyimpan dan mengambil data secara bersamaan', 'Kapasitas lebih besar', 'Bentuknya lebih kecil'], 1],
            ['SDRAM disinkronisasi oleh...', 25, ['CPU', 'Clock sistem', 'Hardisk', 'ROM'], 1],
            ['Kepingan SDRAM terdiri dari...', 25, ['72 pin', '128 pin', '168 pin', '240 pin'], 2],
            ['DDR SDRAM mampu menjalankan instruksi pada gelombang...', 25, ['Positif saja', 'Negatif saja', 'Positif dan negatif', 'Tidak menggunakan gelombang'], 2],
            ['DDR merupakan kependekan dari...', 25, ['Direct Data Rate', 'Double Data Rate', 'Dynamic Data Rate', 'Dual Data RAM'], 1],
            ['Fungsi utama memori (ALU) dalam memproses data adalah...', 25, ['Menyimpan data dari peranti masukan sebelum diproses', 'Menampilkan output', 'Menghubungkan perangkat', 'Mencetak dokumen'], 0],
        ];

        foreach ($questions as $order => $q) {
            $questionId = DB::table('questions')->insertGetId([
                'quiz_id' => $quizId,
                'question_text' => $q[0],
                'time_limit' => $q[1],
                'order' => $order,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($q[2] as $i => $optionText) {
                DB::table('options')->insert([
                    'question_id' => $questionId,
                    'option_text' => $optionText,
                    'is_correct' => $i === $q[3],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    public function down(): void
    {
        $quiz = DB::table('quizzes')->where('code', '7FA9AX')->first();
        if ($quiz) {
            $questionIds = DB::table('questions')->where('quiz_id', $quiz->id)->pluck('id');
            DB::table('options')->whereIn('question_id', $questionIds)->delete();
            DB::table('questions')->where('quiz_id', $quiz->id)->delete();
            DB::table('quizzes')->where('id', $quiz->id)->delete();
        }
    }
};
